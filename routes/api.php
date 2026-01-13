<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AteatendController;
use App\Http\Controllers\AtepacieController;
use App\Http\Controllers\AteconsuController;
use App\Http\Controllers\AtegencController;
use App\Http\Controllers\CanalAtendimentoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Health Check - Verificar Conexão com Banco através do microserviço
Route::get('/health', [HealthController::class, 'check'])->name('api.health');

// Message Service - Envio de mensagens
Route::post('/message/send', [MessageController::class, 'send'])->name('api.message.send');

// Message Service - Verificar status da sessão
Route::get('/message/status', [MessageController::class, 'status'])->name('api.message.status');

// Message Service - Listar canais de atendimento
Route::get('/message/channels', [MessageController::class, 'listChannels'])->name('api.message.channels');

// routes/api.php
Route::get('/canal-atendimento/current', [CanalAtendimentoController::class, 'current'])
    ->name('api.canal-atendimento.current');

Route::post('/canal-atendimento/store-or-update', [CanalAtendimentoController::class, 'storeOrUpdate'])
    ->name('canal-atendimento.storeOrUpdate');

Route::delete('/canal-atendimento/{id}', [CanalAtendimentoController::class, 'destroy'])
    ->name('canal-atendimento.destroy');

// Ateatend Service - Pacientes
Route::get('/ateatend/list', [AteatendController::class, 'list'])->name('api.ateatend.list');
Route::get('/ateatend/count', [AteatendController::class, 'count'])->name('api.ateatend.count');
Route::get('/ateatend/nome/{nome}', [AteatendController::class, 'searchByNome'])->name('api.ateatend.search.nome');
Route::get('/ateatend/id/{id}', [AteatendController::class, 'searchById'])->name('api.ateatend.search.id');
Route::get('/ateatend/documento/{documento}', [AteatendController::class, 'searchByDocumento'])->name('api.ateatend.search.documento');

// Atepacie Service - Pacientes CRUD
Route::get('/atepacie/list', [AtepacieController::class, 'list'])->name('api.atepacie.list');
Route::get('/atepacie/count', [AtepacieController::class, 'count'])->name('api.atepacie.count');
Route::get('/atepacie/numero/{numero}', [AtepacieController::class, 'searchByNumero'])->name('api.atepacie.search.numero');
Route::get('/atepacie/cpf/{cpf}', [AtepacieController::class, 'searchByCpf'])->name('api.atepacie.search.cpf');
Route::get('/atepacie/documento/{documento}', [AtepacieController::class, 'searchByDocumento'])->name('api.atepacie.search.documento');
Route::get('/atepacie/nome/{nome}', [AtepacieController::class, 'searchByNome'])->name('api.atepacie.search.nome');
Route::post('/atepacie', [AtepacieController::class, 'store'])->name('api.atepacie.store');
Route::get('/atepacie/{numero}', [AtepacieController::class, 'show'])->name('api.atepacie.show');
Route::put('/atepacie/{numero}', [AtepacieController::class, 'update'])->name('api.atepacie.update');
Route::delete('/atepacie/{numero}', [AtepacieController::class, 'destroy'])->name('api.atepacie.delete');

// Ateconsu Service - Consultas CRUD
Route::get('/ateconsu/list', [AteconsuController::class, 'list'])->name('api.ateconsu.list');
Route::get('/ateconsu/count', [AteconsuController::class, 'count'])->name('api.ateconsu.count');
Route::get('/ateconsu/numero/{numero}', [AteconsuController::class, 'searchByNumero'])->name('api.ateconsu.search.numero');
Route::get('/ateconsu/nome/{nome}', [AteconsuController::class, 'searchByNome'])->name('api.ateconsu.search.nome');
Route::get('/ateconsu/tipo/{tipo}', [AteconsuController::class, 'searchByTipo'])->name('api.ateconsu.search.tipo');
Route::get('/ateconsu/situacao/{situacao}', [AteconsuController::class, 'searchBySituacao'])->name('api.ateconsu.search.situacao');
Route::get('/ateconsu/especialidade/{especialidade}', [AteconsuController::class, 'searchByEspecialidade'])->name('api.ateconsu.search.especialidade');
Route::get('/ateconsu/medico/{medico}', [AteconsuController::class, 'searchByMedico'])->name('api.ateconsu.search.medico');
Route::get('/ateconsu/setor/{setor}', [AteconsuController::class, 'searchBySetor'])->name('api.ateconsu.search.setor');
Route::post('/ateconsu', [AteconsuController::class, 'store'])->name('api.ateconsu.store');
Route::get('/ateconsu/{numero}', [AteconsuController::class, 'show'])->name('api.ateconsu.show');
Route::put('/ateconsu/{numero}', [AteconsuController::class, 'update'])->name('api.ateconsu.update');
Route::delete('/ateconsu/{numero}', [AteconsuController::class, 'destroy'])->name('api.ateconsu.delete');

// Ategenc Service - Agendamentos CRUD
Route::get('/ateagenc/list', [AtegencController::class, 'list'])->name('api.ateagenclist');
Route::get('/ateagenc/detalhes', [AtegencController::class, 'list'])->name('api.ateagenclist.detalhes');
Route::get('/ateagenc/count', [AtegencController::class, 'count'])->name('api.ateagenccount');
Route::get('/ateagenc/detalhes/{id}', [AtegencController::class, 'searchById'])->name('api.ateagencsearch.detalhes');
Route::get('/ateagenc/nome-consulta/{nome}', [AtegencController::class, 'searchByNomeConsulta'])->name('api.ateagencsearch.nome.consulta');
Route::post('/ateagenc', [AtegencController::class, 'store'])->name('api.ateagencstore');
Route::put('/ateagenc/{id}', [AtegencController::class, 'update'])->name('api.ateagencupdate');
Route::delete('/ateagenc/{id}', [AtegencController::class, 'destroy'])->name('api.ateagencdelete');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
