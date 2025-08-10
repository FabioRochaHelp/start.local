<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoutePermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Se não estiver logado, manda para login
        if (!$user) {
            return redirect()->route('login');
        }

        // Pegamos o nome da rota atual
        $routeName = $request->route()->getName();

        // Se não tiver nome definido na rota, pode decidir negar ou liberar
        if (!$routeName) {
            abort(403, 'Rota sem nome não autorizada.');
        }

        // Verifica usando o mesmo método do seu menu
        // Exemplo: $user->hasPermission('nome-da-rota')
        if (method_exists($user, 'hasPermission') && !$user->hasPermission($routeName)) {
            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}
