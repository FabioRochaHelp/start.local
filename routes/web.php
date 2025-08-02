<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\UserController;

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
        Route::get('/institution/list', 'institutionListView')->name('institution.list.view')->middleware('can:list_institution');
        Route::get('/institution/register', 'institutionRegisterView')->name('institution.register.view')->middleware('can:add_institution');
        Route::post('/institution/register', 'store')->name('institution.register.form')->middleware('can:add_institution');
        Route::get('/institution/edit/{id}', 'institutionEditView')->name('institution.edit.view')->middleware('can:edit_institution');
        Route::post('/institution/edit/{id}', 'edit')->name('institution.edit.form')->middleware('can:edit_institution');
        Route::get('/institution/show/{id}', 'show')->name('institution.show')->middleware('can:list_institution');
        Route::get('/institution/delete/{id}', 'destroy')->name('institution.delete')->middleware('can:delete_institution');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/profile/{id}', 'userProfileView')->name('user.profile.view')->middleware('can:acess_profile');
        Route::get('/user/list', 'userListView')->name('user.list.view')->middleware('can:list_user');
        Route::get('/user/register', 'userRegisterView')->name('user.register.view')->middleware('can:add_user');
        Route::post('/user/register', 'store')->name('user.register.form')->middleware('can:add_user');
        Route::get('/user/edit/{id}', 'userEditView')->name('user.edit.view')->middleware('can:edit_user');
        Route::post('/user/edit/{id}', 'edit')->name('user.edit.form')->middleware('can:edit_user');
        Route::get('/user/permission', 'permission')->name('user.permission.view')->middleware('can:access');
        Route::get('/user/setpermission/{id}', 'setpermission')->name('setpermission')->middleware('can:access');
        Route::get('/user/delete/{id}', 'destroy')->name('user.delete')->middleware('can:delete_user');
        Route::get('/user/search', 'search')->name('user.search')->middleware('can:list_user');
    });

});
