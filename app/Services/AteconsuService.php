<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class AteconsuService
{
    /**
     * URL base do microserviço de consultas
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
        $this->timeout = env('ATECONSU_SERVICE_TIMEOUT', 30);
    }

    /**
     * Busca todas as consultas com paginação
     *
     * @param int $limit
     * @param int $offset
     * @return array
     * @throws Exception
     */
    public function getAllConsultas(int $limit = 100, int $offset = 0): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateconsu';

            Log::info('Buscando todas as consultas', [
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
                
                Log::info('Consultas obtidas com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'pagination' => $data['pagination'] ?? [],
                    'message' => 'Consultas obtidas com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consultas. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consultas', [
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
            Log::error('Exceção ao buscar consultas', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consultas: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Obtém o total de consultas
     *
     * @return array
     * @throws Exception
     */
    public function getCount(): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateconsu/count';

            Log::info('Buscando total de consultas', [
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
                
                Log::info('Total de consultas obtido com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'total' => $data['total'] ?? 0,
                    'data' => $data
                ];
            } else {
                $errorMessage = 'Erro ao buscar total de consultas. Status: ' . $response->status();
                
                Log::error('Erro ao buscar total de consultas', [
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
            Log::error('Exceção ao buscar total de consultas', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar total de consultas: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca consulta por número
     *
     * @param int $numero
     * @return array
     * @throws Exception
     */
    public function getConsultaByNumero(int $numero): array
    {
        try {
            if (empty($numero)) {
                return [
                    'success' => false,
                    'error' => 'Número é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/numero/' . $numero;

            Log::info('Buscando consulta por número', [
                'url' => $url,
                'numero' => $numero
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consulta encontrada por número', [
                    'numero' => $numero,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Consulta encontrada com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consulta por número. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consulta por número', [
                    'numero' => $numero,
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
            Log::error('Exceção ao buscar consulta por número', [
                'numero' => $numero,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consulta por número: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca consultas por nome
     *
     * @param string $nome
     * @return array
     * @throws Exception
     */
    public function getConsultasByNome(string $nome): array
    {
        try {
            if (empty($nome)) {
                return [
                    'success' => false,
                    'error' => 'Nome é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/nome/' . urlencode($nome);

            Log::info('Buscando consultas por nome', [
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
                
                Log::info('Consultas encontradas por nome', [
                    'nome' => $nome,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Consultas encontradas com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consultas por nome. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consultas por nome', [
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
            Log::error('Exceção ao buscar consultas por nome', [
                'nome' => $nome,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consultas por nome: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca consultas por tipo
     *
     * @param string $tipo
     * @return array
     * @throws Exception
     */
    public function getConsultasByTipo(string $tipo): array
    {
        try {
            if (empty($tipo)) {
                return [
                    'success' => false,
                    'error' => 'Tipo é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/tipo/' . urlencode($tipo);

            Log::info('Buscando consultas por tipo', [
                'url' => $url,
                'tipo' => $tipo
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consultas encontradas por tipo', [
                    'tipo' => $tipo,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Consultas encontradas com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consultas por tipo. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consultas por tipo', [
                    'tipo' => $tipo,
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
            Log::error('Exceção ao buscar consultas por tipo', [
                'tipo' => $tipo,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consultas por tipo: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca consultas por situação
     *
     * @param string $situacao
     * @return array
     * @throws Exception
     */
    public function getConsultasBySituacao(string $situacao): array
    {
        try {
            if (empty($situacao)) {
                return [
                    'success' => false,
                    'error' => 'Situação é obrigatória'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/situacao/' . urlencode($situacao);

            Log::info('Buscando consultas por situação', [
                'url' => $url,
                'situacao' => $situacao
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consultas encontradas por situação', [
                    'situacao' => $situacao,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Consultas encontradas com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consultas por situação. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consultas por situação', [
                    'situacao' => $situacao,
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
            Log::error('Exceção ao buscar consultas por situação', [
                'situacao' => $situacao,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consultas por situação: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca consultas por especialidade
     *
     * @param int $especialidade
     * @return array
     * @throws Exception
     */
    public function getConsultasByEspecialidade(int $especialidade): array
    {
        try {
            if (empty($especialidade)) {
                return [
                    'success' => false,
                    'error' => 'Especialidade é obrigatória'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/especialidade/' . $especialidade;

            Log::info('Buscando consultas por especialidade', [
                'url' => $url,
                'especialidade' => $especialidade
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consultas encontradas por especialidade', [
                    'especialidade' => $especialidade,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Consultas encontradas com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consultas por especialidade. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consultas por especialidade', [
                    'especialidade' => $especialidade,
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
            Log::error('Exceção ao buscar consultas por especialidade', [
                'especialidade' => $especialidade,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consultas por especialidade: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca consultas por médico
     *
     * @param int $medico
     * @return array
     * @throws Exception
     */
    public function getConsultasByMedico(int $medico): array
    {
        try {
            if (empty($medico)) {
                return [
                    'success' => false,
                    'error' => 'Médico é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/medico/' . $medico;

            Log::info('Buscando consultas por médico', [
                'url' => $url,
                'medico' => $medico
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consultas encontradas por médico', [
                    'medico' => $medico,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Consultas encontradas com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consultas por médico. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consultas por médico', [
                    'medico' => $medico,
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
            Log::error('Exceção ao buscar consultas por médico', [
                'medico' => $medico,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consultas por médico: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca consultas por setor
     *
     * @param int $setor
     * @return array
     * @throws Exception
     */
    public function getConsultasBySetor(int $setor): array
    {
        try {
            if (empty($setor)) {
                return [
                    'success' => false,
                    'error' => 'Setor é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/setor/' . $setor;

            Log::info('Buscando consultas por setor', [
                'url' => $url,
                'setor' => $setor
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consultas encontradas por setor', [
                    'setor' => $setor,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Consultas encontradas com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar consultas por setor. Status: ' . $response->status();
                
                Log::error('Erro ao buscar consultas por setor', [
                    'setor' => $setor,
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
            Log::error('Exceção ao buscar consultas por setor', [
                'setor' => $setor,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar consultas por setor: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Cria uma nova consulta
     *
     * @param array $consulta
     * @return array
     * @throws Exception
     */
    public function createConsulta(array $consulta): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateconsu';

            Log::info('Criando nova consulta', [
                'url' => $url,
                'consulta' => $consulta
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($url, $consulta);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consulta criada com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => 'Consulta criada com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao criar consulta. Status: ' . $response->status();
                
                Log::error('Erro ao criar consulta', [
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
            Log::error('Exceção ao criar consulta', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao criar consulta: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Atualiza uma consulta existente
     *
     * @param int $numero
     * @param array $consulta
     * @return array
     * @throws Exception
     */
    public function updateConsulta(int $numero, array $consulta): array
    {
        try {
            if (empty($numero)) {
                return [
                    'success' => false,
                    'error' => 'Número da consulta é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/' . $numero;

            Log::info('Atualizando consulta', [
                'url' => $url,
                'numero' => $numero,
                'consulta' => $consulta
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->put($url, $consulta);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consulta atualizada com sucesso', [
                    'numero' => $numero,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => 'Consulta atualizada com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao atualizar consulta. Status: ' . $response->status();
                
                Log::error('Erro ao atualizar consulta', [
                    'numero' => $numero,
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
            Log::error('Exceção ao atualizar consulta', [
                'numero' => $numero,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao atualizar consulta: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Remove uma consulta
     *
     * @param int $numero
     * @return array
     * @throws Exception
     */
    public function deleteConsulta(int $numero): array
    {
        try {
            if (empty($numero)) {
                return [
                    'success' => false,
                    'error' => 'Número da consulta é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateconsu/' . $numero;

            Log::info('Removendo consulta', [
                'url' => $url,
                'numero' => $numero
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->delete($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Consulta removida com sucesso', [
                    'numero' => $numero,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => 'Consulta removida com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao remover consulta. Status: ' . $response->status();
                
                Log::error('Erro ao remover consulta', [
                    'numero' => $numero,
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
            Log::error('Exceção ao remover consulta', [
                'numero' => $numero,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao remover consulta: ' . $e->getMessage(), 0, $e);
        }
    }
}

