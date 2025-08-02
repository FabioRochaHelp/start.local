<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            // Obter o subdomínio atual do inquilino
            $subdomain = $request->getHost();

            // Redirecionar para a página de login no subdomínio atual do inquilino
            return redirect()->away("http://{$subdomain}/login");
        }

        return parent::handle($request, $next, ...$guards);
    }
}