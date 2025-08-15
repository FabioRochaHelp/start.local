<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

use App\Models\UserType;

class UserController extends Controller
{
    public function userProfileView($id): View
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return back();
        }

        return view('user.profile', compact('user'));
    }

    public function index(): View
    {
        $this->authorizeMenuAccess('users');

        $users = User::with('userType')->orderBy('name')->get();
        return view('user.list', compact('users'));
    }

    public function userEditView($id): View
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return back();
        }

        return view('user.edit', compact('user'));
    }

    public function userRegisterView(): View
    {
        $roles = UserType::all();
        return view('user.register', compact('roles'));
    }

    public function permission()
    {
        $users = User::with('collaborator')->orderBy('name')->get();
        // dd($users);
        return view('user.permission-list', compact('users'));
    }

    public function setpermission($id)
    {
        $user = User::with('collaborator')->findOrFail($id);
        if ($user->access_level == 'client') {
            $user->access_level = 'admin';
        } else {
            $user->access_level = 'client';
        }
        $user->save();

        return response()->json(['users' => $user], 200);
    }

    public function edit($id, Request $request)
    {


        $user = User::with('userType')->findOrFail($id);

        $user->name = strtoupper($request->name);
        $user->userType = $request->user_type_id;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $user->phone = preg_replace('/[^0-9]/', '', $request->phone);

        if ($request->hasFile('image')) {
            $imagem = $request->file('image');
            $user->image = $imagem->store('users', 'public');
        }

        $user->save();

        return redirect()->route('users');
    }

    public function store(Request $request)
    {
        $user = new User();

        $user->name = strtoupper($request->name);
        $user->user_type_id = $request->user_type_id;       
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->age = $request->age;
        $user->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $user->phone = preg_replace('/[^0-9]/', '', $request->phone);

        if ($request->hasFile('image')) {
            $imagem = $request->file('image');
            $user->image = $imagem->store('users', 'public');
        }

        $user->save();

        return redirect()->route('users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users');
    }

    public function search(Request $request)
    {
        $query = $request->input('id'); 

        $users = User::select('id', 'name')->where('tenant_id', $query)->get();

        return response()->json($users);
    }
}
