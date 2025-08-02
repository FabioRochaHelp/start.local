<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use App\Services\LogService;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Campo obrigatório',
                'email.email' => 'Este campo deve ser um email valido',
                'password.required' => 'Campo obrigatório',
            ],
        );

        $tokenResponse = $request->get('cf-turnstile-response');

       /*  if ($this->handlePost($tokenResponse) === false) {
            return redirect()
                ->back()
                ->withErrors(['erros' => 'Captcha inválido!']);
        } */

        $autenticated = Auth::attempt($credentials);

        if ($autenticated) {
            $request->session()->regenerate();

            return redirect()
                ->route('home.view')
                ->withErrors(['erros' => 'Email ou senha invalido!']);
        }

        return redirect()
            ->back()
            ->withErrors(['erros' => 'Email ou senha invalido!']);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login.view');
    }

    public function PasswordResetLinkStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = User::where('email', $request->email)->first();

        if ($email === null) {
            return redirect()->back()->with('error', 'Email não encontrado!');
        }
        $token = Crypt::encryptString($email->email . '|' . now());

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return back()->with('success', 'Foi enviado as instruções para redefinição de senha. Verifique seu e-mail.');
    }

    public function PasswordNew(Request $request)
    {
        $request->validate(
            [
                'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                'password_confirmation' => ['required'],
            ],
            [
                'password.required' => 'O campo senha é obrigatório.',
                'password.confirmed' => 'A confirmação da senha não corresponde.',
                'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
                'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, um número e um caractere especial.',
                'password_confirmation.required' => 'O campo de confirmação da senha é obrigatório.',
            ],
        );

        $user = User::where('email', $request->email)->first();

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('login.view')->with('success', 'Senha redefinida com sucesso.');
    }

    public function NewPasswordCreate($token)
    {
        try {
            $decrypted = Crypt::decryptString($token);
        } catch (DecryptException $e) {
            abort(404); // Token inválido ou expirado
        }

        [$email, $timestamp] = explode('|', $decrypted);
        if (Carbon::parse($timestamp)->addMinutes(15)->isPast()) {
            abort(404); // Token expirado
        }

        $user = User::where('email', $email)->first();

        return view('forgot-password', compact('user'));
    }

    public function handlePost($token)
    {
        $SECRET_KEY = getenv('KEY_CAPTCHA');

        // Verifica se o cabeçalho HTTP_CF_CONNECTING_IP está definido
        $ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

        // Valide o token chamando o ponto de extremidade da API "/siteverify".
        $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
        $data = [
            'secret' => $SECRET_KEY,
            'response' => $token,
            'remoteip' => $ip,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        curl_close($ch);

        $outcome = json_decode($result, true);

        if ($outcome['success']) {
            return true;
        } else {
            return false;
        }
    }
}
