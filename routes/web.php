<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
})->name('health');

Route::fallback(function () {
    return view('error-404');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'landpage')->name('landpage.view');
    Route::get('dashboard', 'index')->name('home.view');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login.view');
    Route::post('/login', 'store')->name('login.form');
    Route::get('/logout', 'destroy')->name('logout');

    Route::post('forgot-password', 'PasswordResetLinkStore')->name('password.email');
    Route::post('forgot-new-password', 'PasswordNew')->name('password.new');
    Route::get('reset-password/{token}', 'NewPasswordCreate')->name('password.reset');
});


Route::middleware('auth')->group(function () {

    Route::controller(InstitutionController::class)->group(function () {
        Route::get('/institution/list', 'institutionListView')->name('institution.list.view');
        Route::get('/institution/register', 'institutionRegisterView')->name('institution.register.view');
        Route::post('/institution/register', 'store')->name('institution.register.form');
        Route::get('/institution/edit/{id}', 'institutionEditView')->name('institution.edit.view');
        Route::post('/institution/edit/{id}', 'edit')->name('institution.edit.form');
        Route::get('/institution/show/{id}', 'show')->name('institution.show');
        Route::get('/institution/delete/{id}', 'destroy')->name('institution.delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/profile/{id}', 'userProfileView')->name('user.profile.view');
        Route::get('/users', 'userListView')->name('users');
        Route::get('/user/register', 'userRegisterView')->name('user.register.view');
        Route::post('/user/register', 'store')->name('user.register.form');
        Route::get('/user/edit/{id}', 'userEditView')->name('user.edit.view');
        Route::post('/user/edit/{id}', 'edit')->name('user.edit.form');
        Route::get('/user/permission', 'permission')->name('user.permission.view');
        Route::get('/user/setpermission/{id}', 'setpermission')->name('setpermission');
        Route::get('/user/delete/{id}', 'destroy')->name('user.delete');
        Route::get('/user/search', 'search')->name('user.search');
    });

    Route::controller(MenuController::class)->group(function () {
        Route::get('/menu', 'index')->name('menu');
        Route::get('/menu/register', 'registerView')->name('menu.register.view');
        Route::post('/menu/register', 'store')->name('menu.register.form');
        Route::get('/menu/edit/{id}', 'editView')->name('menu.edit.view');
        Route::post('/menu/edit/{id}', 'edit')->name('menu.edit.form');
        Route::get('/menu/delete/{id}', 'destroy')->name('menu.delete');
    });

    Route::controller(SubMenuController::class)->group(function () {
        Route::get('/submenu/list/{menu}', 'index')->name('submenu.list');
        Route::get('/submenu/register/{menu}', 'create')->name('submenu.register.view');
        Route::post('/submenu/register/{menu}', 'store')->name('submenu.register.form');
        Route::get('/submenu/edit/{id}', 'edit')->name('submenu.edit.view');
        Route::post('/submenu/edit/{id}', 'update')->name('submenu.edit.form');
        Route::get('/submenu/delete/{id}', 'destroy')->name('submenu.delete');
    });
    
});
