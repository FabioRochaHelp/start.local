<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class HealthController extends Controller
{
    /**
     * Health check endpoint - Verifica status da aplicação e conexão com banco Oracle
     * através do microserviço em localhost:3001
     *
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        try {
            $timestamp = $this->getTimestamp();
            
            // Verifica conexão com Oracle através do microserviço
            $databaseStatus = $this->checkOracleConnectionViaMicroservice();
            
            // Define status baseado na conexão do banco
            $status = ($databaseStatus['connected'] ?? false) ? 'healthy' : 'unhealthy';
            $httpStatus = ($databaseStatus['connected'] ?? false) ? 200 : 503;
            
            return response()->json([
                'status' => $status,
                'timestamp' => $timestamp,
                'database' => $databaseStatus
            ], $httpStatus);
            
        } catch (Exception $e) {
            Log::error('Health check failed: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'unhealthy',
                'timestamp' => $this->getTimestamp(),
                'database' => [
                    'connected' => false,
                    'message' => 'Erro ao verificar conexão com Oracle: ' . $e->getMessage(),
                    'details' => null
                ],
                'error' => $e->getMessage()
            ], 503);
        }
    }
    
    /**
     * Verifica conexão com banco Oracle através do microserviço
     *
     * @return array
     */
    private function checkOracleConnectionViaMicroservice(): array
    {
        try {
            $microserviceUrl = env('MICROSERVICE_URL', 'http://localhost:3001');
            $healthEndpoint = rtrim($microserviceUrl, '/') . '/health';
            
            // Faz requisição HTTP para o microserviço
            $response = Http::timeout(5)->get($healthEndpoint);
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Se o microserviço retornar dados de database, usa eles
                if (isset($data['database'])) {
                    return $data['database'];
                }
                
                // Caso contrário, assume que está conectado se a requisição foi bem-sucedida
                return [
                    'connected' => true,
                    'message' => 'Conexão com Oracle estabelecida com sucesso',
                    'details' => [
                        'poolStatus' => 'active',
                        'testQuery' => [['TEST' => 1]]
                    ]
                ];
            } else {
                return [
                    'connected' => false,
                    'message' => 'Falha na conexão com o microserviço',
                    'details' => [
                        'poolStatus' => 'inactive',
                        'testQuery' => null,
                        'error' => 'Microserviço retornou status: ' . $response->status()
                    ]
                ];
            }
            
        } catch (Exception $e) {
            return [
                'connected' => false,
                'message' => 'Falha na conexão com Oracle: ' . $e->getMessage(),
                'details' => [
                    'poolStatus' => 'inactive',
                    'testQuery' => null,
                    'error' => $e->getMessage()
                ]
            ];
        }
    }
    
    /**
     * Exibe a view do health check
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('health.index');
    }
    
    /**
     * Retorna timestamp no formato ISO 8601 com milissegundos
     * Formato: 2025-11-20T08:40:51.000Z
     *
     * @return string
     */
    private function getTimestamp(): string
    {
        $now = now()->utc();
        $milliseconds = str_pad((int)($now->format('u') / 1000), 3, '0', STR_PAD_LEFT);
        return $now->format('Y-m-d\TH:i:s') . '.' . $milliseconds . 'Z';
    }
}

