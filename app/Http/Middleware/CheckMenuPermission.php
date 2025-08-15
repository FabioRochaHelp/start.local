<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MenuUsersType;
use App\Models\SubMenuUsersType;

class CheckMenuPermission
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Acesso negado.');
        }

        // Captura o nome da rota atual
        $currentRoute = $request->route()->getName();

        // Carrega relacionamentos de menus/submenus permitidos para este tipo de usuário
        $menuUsersTypes = MenuUsersType::with('menu')->where('user_type_id', $user->user_type_id)->get();
        $subMenuUsersTypes = SubMenuUsersType::with('subMenu')->where('user_type_id', $user->user_type_id)->get();

        dd($menuUsersTypes, $subMenuUsersTypes, $currentRoute);

        // Verifica se a rota está vinculada a algum submenu permitido
        $hasPermission = $subMenuUsersTypes->contains(function ($item) use ($currentRoute) {
            return $item->subMenu->url === $currentRoute;
        });

        if (!$hasPermission) {
            abort(403, 'Você não tem permissão para acessar esta rota.');
        }

        return $next($request);
    }
}
