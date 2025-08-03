<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Compartilha $menus com todas as views
        View::composer('*', function ($view) {
            $view->with('menus', Menu::with('subMenus')->get());
        });
    }
}
