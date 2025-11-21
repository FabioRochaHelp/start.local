<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class AteatendService
{
    /**
     * URL base do microserviço de atendimento
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
        $this->timeout = env('ATEATEND_SERVICE_TIMEOUT', 30);
    }

    /**
     * Busca todos os pacientes com paginação
     *
     * @param int $limit
     * @param int $offset
     * @return array
     * @throws Exception
     */
    public function getAllPacientes(int $limit = 100, int $offset = 0): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateatend';

            Log::info('Buscando todos os pacientes', [
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
                
                Log::info('Pacientes obtidos com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'pagination' => $data['pagination'] ?? [],
                    'message' => 'Pacientes obtidos com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar pacientes. Status: ' . $response->status();
                
                Log::error('Erro ao buscar pacientes', [
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
            Log::error('Exceção ao buscar pacientes', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar pacientes: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Obtém o total de pacientes
     *
     * @return array
     * @throws Exception
     */
    public function getCount(): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/ateatend/count';

            Log::info('Buscando total de pacientes', [
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
                
                Log::info('Total de pacientes obtido com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'total' => $data['total'] ?? 0,
                    'data' => $data
                ];
            } else {
                $errorMessage = 'Erro ao buscar total de pacientes. Status: ' . $response->status();
                
                Log::error('Erro ao buscar total de pacientes', [
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
            Log::error('Exceção ao buscar total de pacientes', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar total de pacientes: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca pacientes por nome
     *
     * @param string $nome
     * @return array
     * @throws Exception
     */
    public function getPacienteByNome(string $nome): array
    {
        try {
            if (empty($nome)) {
                return [
                    'success' => false,
                    'error' => 'Nome é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateatend/nome/' . urlencode($nome);

            Log::info('Buscando paciente por nome', [
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
                
                Log::info('Paciente encontrado por nome', [
                    'nome' => $nome,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Paciente encontrado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar paciente por nome. Status: ' . $response->status();
                
                Log::error('Erro ao buscar paciente por nome', [
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
            Log::error('Exceção ao buscar paciente por nome', [
                'nome' => $nome,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar paciente por nome: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca paciente por ID
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getPacienteById(int $id): array
    {
        try {
            if (empty($id)) {
                return [
                    'success' => false,
                    'error' => 'ID é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateatend/id/' . $id;

            Log::info('Buscando paciente por ID', [
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
                
                Log::info('Paciente encontrado por ID', [
                    'id' => $id,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? null,
                    'message' => 'Paciente encontrado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar paciente por ID. Status: ' . $response->status();
                
                Log::error('Erro ao buscar paciente por ID', [
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
            Log::error('Exceção ao buscar paciente por ID', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar paciente por ID: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca pacientes por documento
     *
     * @param string $documento
     * @return array
     * @throws Exception
     */
    public function getPacienteByDocumento(string $documento): array
    {
        try {
            if (empty($documento)) {
                return [
                    'success' => false,
                    'error' => 'Documento é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/ateatend/' . urlencode($documento);

            Log::info('Buscando paciente por documento', [
                'url' => $url,
                'documento' => $documento
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Paciente encontrado por documento', [
                    'documento' => $documento,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Paciente encontrado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar paciente por documento. Status: ' . $response->status();
                
                Log::error('Erro ao buscar paciente por documento', [
                    'documento' => $documento,
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
            Log::error('Exceção ao buscar paciente por documento', [
                'documento' => $documento,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar paciente por documento: ' . $e->getMessage(), 0, $e);
        }
    }
}

