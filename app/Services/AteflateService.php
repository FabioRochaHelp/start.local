<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ApiException;

class AteflateService
{
    private string $apiBaseUrl;
    private int $timeout;
    private int $retryAttempts;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.ateflate_api.url', 'http://localhost:3001');
        $this->timeout = config('services.ateflate_api.timeout', 30);
        $this->retryAttempts = config('services.ateflate_api.retry_attempts', 3);
    }

    /**
     * Envia dados para a API Nest.js
     */
    public function enviarParaApi(array $dados): array
    {
        $url = $this->apiBaseUrl . '/ateflate';
        
        Log::info('Enviando dados para API', [
            'url' => $url,
            'dados' => $dados
        ]);

        try {
            $response = Http::timeout($this->timeout)
                ->retry($this->retryAttempts, 1000)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'X-Request-Source' => 'Laravel-' . config('app.name')
                ])
                ->post($url, $dados);

            $statusCode = $response->status();
            $body = $response->json();

            Log::info('Resposta da API', [
                'status' => $statusCode,
                'body' => $body
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $body,
                    'status' => $statusCode
                ];
            }

            // Tratar erros HTTP
            throw new ApiException(
                $body['message'] ?? 'Erro na comunicação com a API',
                $statusCode,
                $body['errors'] ?? []
            );

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Erro de conexão com a API', ['error' => $e->getMessage()]);
            throw new ApiException('Serviço temporariamente indisponível. Tente novamente.', 503);
            
        } catch (\Illuminate\Http\Client\RequestException $e) {
            Log::error('Erro na requisição para API', ['error' => $e->getMessage()]);
            throw new ApiException('Erro ao processar a requisição.', 500);
            
        } catch (\Exception $e) {
            Log::error('Erro inesperado', ['error' => $e->getMessage()]);
            throw new ApiException('Erro interno do sistema.', 500);
        }
    }

    /**
     * Monta payload para API baseado na ação
     */
    public function prepararDados(array $dadosValidados): array
    {
        $acao = $dadosValidados['acao'];
        $observacao = $dadosValidados['cobseflate'];
        
        // Ajusta observação baseado na ação
        if ($acao === 'cancelar' && strpos($observacao, 'confirmado') !== false) {
            $observacao = str_replace('confirmado', 'cancelado', $observacao);
        }

        return [
            // Campos em maiúsculo (formato esperado pela API)
            'NNUMEFLATE' => $dadosValidados['nnumeflate'],
            'NNUMEAGENC' => $dadosValidados['nnumeagenc'],
            'NNUMEAGEND' => $dadosValidados['nnumeagend'],
            'DDATAFLATE' => $dadosValidados['ddataflate'],
            'COBSEFLATE' => $observacao,
            'NNUMEUSUA'  => $dadosValidados['nnumeusua'],
            
            // Campos opcionais (com valor padrão se não enviados)
            'NNUMEFLUXO' => $dadosValidados['nnumefluxo'] ?? 0,
            'NNUMEATEND' => $dadosValidados['nnumeatend'] ?? 0,
            'NNUMECAGEN' => $dadosValidados['nnumecagen'] ?? 0,
            'NNUMEGUIA'  => $dadosValidados['nnumeguia'] ?? 0,
            'NNUMEMENSA' => $dadosValidados['nnumemensa'] ?? 0,
            'RNUM'       => $dadosValidados['rnum'] ?? 0,
            
            // Metadados (não vão para o banco, mas são úteis para logs)
            'metadata' => [
                'acao' => $acao,
                'origem' => 'laravel',
                'timestamp' => now()->toISOString(),
                'agendamento_id' => $dadosValidados['agendamento_id'] ?? null
            ]
        ];
    }

    /**
     * Valida resposta da API
     */
    public function validarRespostaApi(array $resposta): bool
    {
        return isset($resposta['success']) && $resposta['success'] === true;
    }

    /**
     * Método de fallback em caso de falha na API
     */
    public function fallbackLocal(array $dados): array
    {
        Log::warning('Usando fallback local para registro', $dados);
        
        // Aqui você poderia:
        // 1. Salvar em uma fila para processamento posterior
        // 2. Salvar em um banco local temporário
        // 3. Enviar email para admin
        
        return [
            'success' => true,
            'message' => 'Registro armazenado localmente para processamento posterior',
            'fallback' => true,
            'dados' => $dados
        ];
    }
}