<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AteatendController;

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

// Ateatend Service - Pacientes
Route::get('/ateatend/list', [AteatendController::class, 'list'])->name('api.ateatend.list');
Route::get('/ateatend/count', [AteatendController::class, 'count'])->name('api.ateatend.count');
Route::get('/ateatend/nome/{nome}', [AteatendController::class, 'searchByNome'])->name('api.ateatend.search.nome');
Route::get('/ateatend/id/{id}', [AteatendController::class, 'searchById'])->name('api.ateatend.search.id');
Route::get('/ateatend/documento/{documento}', [AteatendController::class, 'searchByDocumento'])->name('api.ateatend.search.documento');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
