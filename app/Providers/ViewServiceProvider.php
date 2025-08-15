<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\MenuUsersType;
use App\Models\SubMenuUsersType;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $menuUsersTypes = MenuUsersType::all();
        $subMenuUsersTypes = SubMenuUsersType::all();

        View::share('menuUsersTypes', $menuUsersTypes);
        View::share('subMenuUsersTypes', $subMenuUsersTypes);
        View::composer('*', function ($view) {
            $view->with(
                'menus',
                Menu::with([
                    'subMenus' => function ($query) {
                        $query->where('direct', 1);
                    },
                ])
                    ->whereHas('subMenus', function ($query) {
                        $query->where('direct', 1);
                    })
                    ->get(),
            );
        });
    }
}
