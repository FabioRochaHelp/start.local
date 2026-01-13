<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AteatendController;
use App\Http\Controllers\AtepacieController;
use App\Http\Controllers\AteconsuController;
use App\Http\Controllers\AtegencController;
use App\Http\Controllers\AteflateController;

Route::get('/health', [HealthController::class, 'index'])->name('health.view');
Route::get('/message', [MessageController::class, 'index'])->name('message.view');
Route::get('/ateatend', [AteatendController::class, 'index'])->name('ateatend.index');
Route::get('/atepacie', [AtepacieController::class, 'index'])->name('atepacie.index');
Route::get('/ateconsu', [AteconsuController::class, 'index'])->name('ateconsu.index');
Route::get('/ateagenc', [AtegencController::class, 'index'])->name('ateagenc.index');

// Rotas de confirmação de agendamento
Route::prefix('confirmar-agendamento')
    ->name('ateflate.')
    ->group(function () {
        Route::get('/{id}', [AteflateController::class, 'showConfirmacao'])
            ->name('confirmacao.show')
            ->where('id', '[0-9]+');

        Route::post('/processar', [AteflateController::class, 'processar'])->name('processar');

        Route::get('/sucesso', [AteflateController::class, 'sucesso'])->name('confirmacao.sucesso'); // 🔥 CORRIGIDO: Remove 'ateflate.'
    });
// Rotas públicas para confirmação de agendamento (acessível via link do WhatsApp, funciona com ou sem autenticação)
Route::get('/agendamentos/confirmar/{id}', [AtegencController::class, 'confirmar'])->name('ateagenc.confirmar');
Route::post('/agendamentos/confirmar/{id}', [AtegencController::class, 'processarConfirmacao'])->name('ateagenc.processar.confirmacao');

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

Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/profile/{id}', 'userProfileView')->name('user.profile.view');
        Route::get('/users', 'index')->name('users');
        Route::get('/user/register', 'userRegisterView')->name('user.register.view');
        Route::post('/user/register', 'store')->name('user.register.form');
        Route::get('/user/edit/{id}', 'userEditView')->name('user.edit.view');
        Route::post('/user/edit/{id}', 'edit')->name('user.edit.form');
        Route::get('/user/permission', 'permission')->name('user.permission.view');
        Route::get('/user/setpermission/{id}', 'setpermission')->name('setpermission');
        Route::get('/user/delete/{id}', 'destroy')->name('user.delete');
        Route::get('/user/search', 'search')->name('user.search');
        Route::get('test', 'test')->name('teste.index');
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

    Route::controller(AteatendController::class)->group(function () {
        Route::get('/ateatend/list', 'list')->name('ateatend.list');
        Route::get('/ateatend/search/nome/{nome}', 'searchByNome')->name('ateatend.search.nome.param');
        Route::get('/ateatend/search/nome', 'searchByNome')->name('ateatend.search.nome');
        Route::get('/ateatend/search/id/{id}', 'searchById')->name('ateatend.search.id.param');
        Route::get('/ateatend/search/id', 'searchById')->name('ateatend.search.id');
        Route::get('/ateatend/search/documento/{documento}', 'searchByDocumento')->name('ateatend.search.documento.param');
        Route::get('/ateatend/search/documento', 'searchByDocumento')->name('ateatend.search.documento');
    });

    Route::controller(AtepacieController::class)->group(function () {
        Route::get('/atepacie/list', 'list')->name('atepacie.list');
        Route::get('/atepacie/create', 'create')->name('atepacie.create');
        Route::post('/atepacie/store', 'store')->name('atepacie.store');
        Route::get('/atepacie/show/{numero}', 'show')->name('atepacie.show');
        Route::get('/atepacie/edit/{numero}', 'edit')->name('atepacie.edit');
        Route::put('/atepacie/update/{numero}', 'update')->name('atepacie.update');
        Route::get('/atepacie/delete/{numero}', 'destroy')->name('atepacie.delete');
        Route::get('/atepacie/search/numero/{numero}', 'searchByNumero')->name('atepacie.search.numero.param');
        Route::get('/atepacie/search/numero', 'searchByNumero')->name('atepacie.search.numero');
        Route::get('/atepacie/search/cpf/{cpf}', 'searchByCpf')->name('atepacie.search.cpf.param');
        Route::get('/atepacie/search/cpf', 'searchByCpf')->name('atepacie.search.cpf');
        Route::get('/atepacie/search/documento/{documento}', 'searchByDocumento')->name('atepacie.search.documento.param');
        Route::get('/atepacie/search/documento', 'searchByDocumento')->name('atepacie.search.documento');
        Route::get('/atepacie/search/nome/{nome}', 'searchByNome')->name('atepacie.search.nome.param');
        Route::get('/atepacie/search/nome', 'searchByNome')->name('atepacie.search.nome');
    });

    Route::controller(AteconsuController::class)->group(function () {
        Route::get('/ateconsu/list', 'list')->name('ateconsu.list');
        Route::get('/ateconsu/create', 'create')->name('ateconsu.create');
        Route::post('/ateconsu/store', 'store')->name('ateconsu.store');
        Route::get('/ateconsu/show/{numero}', 'show')->name('ateconsu.show');
        Route::get('/ateconsu/edit/{numero}', 'edit')->name('ateconsu.edit');
        Route::put('/ateconsu/update/{numero}', 'update')->name('ateconsu.update');
        Route::get('/ateconsu/delete/{numero}', 'destroy')->name('ateconsu.delete');
        Route::get('/ateconsu/search/numero/{numero}', 'searchByNumero')->name('ateconsu.search.numero.param');
        Route::get('/ateconsu/search/numero', 'searchByNumero')->name('ateconsu.search.numero');
        Route::get('/ateconsu/search/nome/{nome}', 'searchByNome')->name('ateconsu.search.nome.param');
        Route::get('/ateconsu/search/nome', 'searchByNome')->name('ateconsu.search.nome');
        Route::get('/ateconsu/search/tipo/{tipo}', 'searchByTipo')->name('ateconsu.search.tipo.param');
        Route::get('/ateconsu/search/tipo', 'searchByTipo')->name('ateconsu.search.tipo');
        Route::get('/ateconsu/search/situacao/{situacao}', 'searchBySituacao')->name('ateconsu.search.situacao.param');
        Route::get('/ateconsu/search/situacao', 'searchBySituacao')->name('ateconsu.search.situacao');
        Route::get('/ateconsu/search/especialidade/{especialidade}', 'searchByEspecialidade')->name('ateconsu.search.especialidade.param');
        Route::get('/ateconsu/search/especialidade', 'searchByEspecialidade')->name('ateconsu.search.especialidade');
        Route::get('/ateconsu/search/medico/{medico}', 'searchByMedico')->name('ateconsu.search.medico.param');
        Route::get('/ateconsu/search/medico', 'searchByMedico')->name('ateconsu.search.medico');
        Route::get('/ateconsu/search/setor/{setor}', 'searchBySetor')->name('ateconsu.search.setor.param');
        Route::get('/ateconsu/search/setor', 'searchBySetor')->name('ateconsu.search.setor');
    });

    Route::controller(AtegencController::class)->group(function () {
        Route::get('/ateagenc/list', 'list')->name('ateagenc.list');
        Route::get('/ateagenc/create', 'create')->name('ateagenc.create');
        Route::post('/ateagenc/store', 'store')->name('ateagenc.store');
        Route::get('/ateagenc/show/{id}', 'show')->name('ateagenc.show');
        Route::get('/ateagenc/edit/{id}', 'edit')->name('ateagenc.edit');
        Route::put('/ateagenc/update/{id}', 'update')->name('ateagenc.update');
        Route::get('/ateagenc/delete/{id}', 'destroy')->name('ateagenc.delete');
        Route::get('/ateagenc/search/id/{id}', 'searchById')->name('ateagenc.search.id.param');
        Route::get('/ateagenc/search/id', 'searchById')->name('ateagenc.search.id');
        Route::get('/ateagenc/search/nome-consulta/{nome}', 'searchByNomeConsulta')->name('ateagenc.search.nome.consulta.param');
        Route::get('/ateagenc/search/nome-consulta', 'searchByNomeConsulta')->name('ateagenc.search.nome.consulta');
    });

    Route::controller(MessageController::class)->group(function () {
        Route::get('/message/send', 'sendMessageView')->name('message.send.view');
        Route::post('/message/send', 'sendMessage')->name('message.send.form');
        Route::get('/message/status', 'statusView')->name('message.status.view');
        Route::post('/message/status', 'status')->name('message.status.form');
      
        Route::post('/message/channels', 'listChannels')->name('message.channels.form');
    });
});
