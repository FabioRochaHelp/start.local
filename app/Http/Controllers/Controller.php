<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\SubMenuUsersType;
use Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function authorizeMenuAccess(string $routeName)
    {
        $user = Auth::user();

        // Se não estiver logado, bloqueia
        if (!$user) {
            abort(403, 'Acesso negado.');
        }

        // Busca permissões para o tipo de usuário
        $allowedRoutes = SubMenuUsersType::with('subMenu')
            ->where('user_type_id', $user->user_type_id)
            ->get()
            ->pluck('subMenu.url')
            ->filter() // remove nulos
            ->toArray();

        if (!in_array($routeName, $allowedRoutes)) {
            abort(403, 'Você não tem permissão para acessar esta rota.');
        }
    }
}
