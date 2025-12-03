<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class AtepacieService
{
    /**
     * URL base do microserviço de pacientes
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
        $this->timeout = env('ATEPACIE_SERVICE_TIMEOUT', 30);
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
            $url = rtrim($this->baseUrl, '/') . '/atepacie';

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
            $url = rtrim($this->baseUrl, '/') . '/atepacie/count';

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
     * Busca paciente por número (NNUMEPACIE)
     *
     * @param int $numero
     * @return array
     * @throws Exception
     */
    public function getPacienteByNumero(int $numero): array
    {
        try {
            if (empty($numero)) {
                return [
                    'success' => false,
                    'error' => 'Número é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/atepacie/numero/' . $numero;

            Log::info('Buscando paciente por número', [
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
                
                Log::info('Paciente encontrado por número', [
                    'numero' => $numero,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Paciente encontrado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar paciente por número. Status: ' . $response->status();
                
                Log::error('Erro ao buscar paciente por número', [
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
            Log::error('Exceção ao buscar paciente por número', [
                'numero' => $numero,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar paciente por número: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Busca pacientes por CPF
     *
     * @param string $cpf
     * @return array
     * @throws Exception
     */
    public function getPacienteByCpf(string $cpf): array
    {
        try {
            if (empty($cpf)) {
                return [
                    'success' => false,
                    'error' => 'CPF é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/atepacie/cpf/' . urlencode($cpf);

            Log::info('Buscando paciente por CPF', [
                'url' => $url,
                'cpf' => $cpf
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Paciente encontrado por CPF', [
                    'cpf' => $cpf,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? [],
                    'message' => 'Paciente encontrado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao buscar paciente por CPF. Status: ' . $response->status();
                
                Log::error('Erro ao buscar paciente por CPF', [
                    'cpf' => $cpf,
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
            Log::error('Exceção ao buscar paciente por CPF', [
                'cpf' => $cpf,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao buscar paciente por CPF: ' . $e->getMessage(), 0, $e);
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

            $url = rtrim($this->baseUrl, '/') . '/atepacie/documento/' . urlencode($documento);

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

            $url = rtrim($this->baseUrl, '/') . '/atepacie/nome/' . urlencode($nome);

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
     * Cria um novo paciente
     *
     * @param array $paciente
     * @return array
     * @throws Exception
     */
    public function createPaciente(array $paciente): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/atepacie';

            Log::info('Criando novo paciente', [
                'url' => $url,
                'paciente' => $paciente
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($url, $paciente);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Paciente criado com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => 'Paciente criado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao criar paciente. Status: ' . $response->status();
                
                Log::error('Erro ao criar paciente', [
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
            Log::error('Exceção ao criar paciente', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao criar paciente: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Atualiza um paciente existente
     *
     * @param int $numero
     * @param array $paciente
     * @return array
     * @throws Exception
     */
    public function updatePaciente(int $numero, array $paciente): array
    {
        try {
            if (empty($numero)) {
                return [
                    'success' => false,
                    'error' => 'Número do paciente é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/atepacie/' . $numero;

            Log::info('Atualizando paciente', [
                'url' => $url,
                'numero' => $numero,
                'paciente' => $paciente
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->put($url, $paciente);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Paciente atualizado com sucesso', [
                    'numero' => $numero,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => 'Paciente atualizado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao atualizar paciente. Status: ' . $response->status();
                
                Log::error('Erro ao atualizar paciente', [
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
            Log::error('Exceção ao atualizar paciente', [
                'numero' => $numero,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao atualizar paciente: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Remove um paciente
     *
     * @param int $numero
     * @return array
     * @throws Exception
     */
    public function deletePaciente(int $numero): array
    {
        try {
            if (empty($numero)) {
                return [
                    'success' => false,
                    'error' => 'Número do paciente é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/atepacie/' . $numero;

            Log::info('Removendo paciente', [
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
                
                Log::info('Paciente removido com sucesso', [
                    'numero' => $numero,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data['data'] ?? $data,
                    'message' => 'Paciente removido com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao remover paciente. Status: ' . $response->status();
                
                Log::error('Erro ao remover paciente', [
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
            Log::error('Exceção ao remover paciente', [
                'numero' => $numero,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao remover paciente: ' . $e->getMessage(), 0, $e);
        }
    }
}

