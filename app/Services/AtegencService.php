<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class AtegencService
{
    /**
     * URL base do microserviço de agendamentos
     *
     * @var string
     */
    private $baseUrl;

    /**
     * Timeout para requisições HTTP (em segundos)
     *
     * @var int
     */
    private $timeout;

    /**
     * Construtor
     */
    public function __construct()
    {
        $this->baseUrl = env('MICROSERVICE_URL', 'http://localhost:3001');
        $this->timeout = env('ATEGENC_SERVICE_TIMEOUT', 30);
    }

    /**
     * Busca todos os agendamentos com paginação
     *
     * @param int $limit
     * @param int $offset
     * @param bool $completo
     * @return array
     * @throws Exception
     */
    public function getAllAgendamentos(int $limit = 100, int $offset = 0, bool $completo = false): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateagenc';

            Log::info('Buscando todos os agendamentos', [
                'url' => $url,
                'limit' => $limit,
                'offset' => $offset,
                'completo' => $completo
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url, [
                    'limit' => $limit,
                    'offset' => $offset,
                    'completo' => $completo ? 'true' : 'false'
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Agendamentos obtidos com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'pagination' => $data['pagination'] ?? [],
                    'message' => 'Agendamentos obtidos com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar agendamentos. Status: ' . $response->status();
                
                Log::error('Erro ao buscar agendamentos', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao buscar agendamentos', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar agendamentos: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca todos os agendamentos com detalhes completos estruturados
     *
     * @param int $limit
     * @param int $offset
     * @return array
     * @throws Exception
     */
    public function getAllDetalhes(int $limit = 100, int $offset = 0): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateagenc/detalhes';

            Log::info('Buscando todos os agendamentos com detalhes', [
                'url' => $url,
                'limit' => $limit,
                'offset' => $offset
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url, [
                    'limit' => $limit,
                    'offset' => $offset
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Agendamentos com detalhes obtidos com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'pagination' => $data['pagination'] ?? [],
                    'message' => 'Agendamentos obtidos com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar agendamentos com detalhes. Status: ' . $response->status();
                
                Log::error('Erro ao buscar agendamentos com detalhes', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao buscar agendamentos com detalhes', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar agendamentos com detalhes: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Obtém o total de agendamentos
     *
     * @return array
     * @throws Exception
     */
    public function getCount(): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateagenc/count';

            Log::info('Buscando total de agendamentos', [
                'url' => $url
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Total de agendamentos obtido com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'total' => $data['total'] ?? 0,
                    'data' => $data
                ];
            } else {
                $errorMessage = 'Erro ao buscar total de agendamentos. Status: ' . $response->status();
                
                Log::error('Erro ao buscar total de agendamentos', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao buscar total de agendamentos', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar total de agendamentos: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca detalhes completos do agendamento por ID
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getDetalhesById(int $id): array
    {
        try {
            if (empty($id)) {
                return [
                    'success' => false,
                    'error' => 'ID é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateagenc/detalhes/' . $id;

            Log::info('Buscando detalhes do agendamento por ID', [
                'url' => $url,
                'id' => $id
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Detalhes do agendamento encontrados', [
                    'id' => $id,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? null,
                    'message' => 'Detalhes do agendamento encontrados com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar detalhes do agendamento. Status: ' . $response->status();
                
                Log::error('Erro ao buscar detalhes do agendamento', [
                    'id' => $id,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao buscar detalhes do agendamento', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar detalhes do agendamento: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca agendamentos por nome da consulta
     *
     * @param string $nome
     * @return array
     * @throws Exception
     */
    public function getAgendamentosByNomeConsulta(string $nome): array
    {
        try {
            if (empty($nome)) {
                return [
                    'success' => false,
                    'error' => 'Nome é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateagenc/nome-consulta/' . urlencode($nome);

            Log::info('Buscando agendamentos por nome da consulta', [
                'url' => $url,
                'nome' => $nome
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Agendamentos encontrados por nome da consulta', [
                    'nome' => $nome,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Agendamentos encontrados com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar agendamentos por nome da consulta. Status: ' . $response->status();
                
                Log::error('Erro ao buscar agendamentos por nome da consulta', [
                    'nome' => $nome,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao buscar agendamentos por nome da consulta', [
                'nome' => $nome,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar agendamentos por nome da consulta: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Cria um novo agendamento
     *
     * @param array $agendamento
     * @return array
     * @throws Exception
     */
    public function createAgendamento(array $agendamento): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateagenc';

            Log::info('Criando novo agendamento', [
                'url' => $url,
                'agendamento' => $agendamento
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($url, $agendamento);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Agendamento criado com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => $data['message'] ?? 'Agendamento criado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao criar agendamento. Status: ' . $response->status();
                
                Log::error('Erro ao criar agendamento', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao criar agendamento', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao criar agendamento: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Atualiza um agendamento existente
     *
     * @param int $id
     * @param array $agendamento
     * @return array
     * @throws Exception
     */
    public function updateAgendamento(int $id, array $agendamento): array
    {
        try {
            if (empty($id)) {
                return [
                    'success' => false,
                    'error' => 'ID do agendamento é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateagenc/' . $id;

            Log::info('Atualizando agendamento', [
                'url' => $url,
                'id' => $id,
                'agendamento' => $agendamento
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->put($url, $agendamento);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Agendamento atualizado com sucesso', [
                    'id' => $id,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => $data['message'] ?? 'Agendamento atualizado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao atualizar agendamento. Status: ' . $response->status();
                
                Log::error('Erro ao atualizar agendamento', [
                    'id' => $id,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao atualizar agendamento', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao atualizar agendamento: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Remove um agendamento
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function deleteAgendamento(int $id): array
    {
        try {
            if (empty($id)) {
                return [
                    'success' => false,
                    'error' => 'ID do agendamento é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateagenc/' . $id;

            Log::info('Removendo agendamento', [
                'url' => $url,
                'id' => $id
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->delete($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Agendamento removido com sucesso', [
                    'id' => $id,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => $data['message'] ?? 'Agendamento removido com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao remover agendamento. Status: ' . $response->status();
                
                Log::error('Erro ao remover agendamento', [
                    'id' => $id,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'data' => $response->json()
                ];
            }

        } catch (Exception $e) {
            Log::error('Exceção ao remover agendamento', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao remover agendamento: ' . $e->getMessage(), 0, $e);
        }
    }
}
