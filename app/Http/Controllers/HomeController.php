<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\MenuUsersType;
use App\Models\SubMenuUsersType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $menus = Menu::all();

        return view('home', [
            'menus' => $menus,
            'user' => $user,
        ]);
    }

    public function landpage()
    {
        return view('landpage.index');
    }
}
