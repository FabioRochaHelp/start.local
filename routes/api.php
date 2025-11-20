<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\MessageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
