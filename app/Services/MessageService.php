<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class MessageService
{
    /**
     * URL base do microserviço de mensagens
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
        $this->baseUrl = env('MESSAGE_SERVICE_URL', 'https://api.wts.chat/chat/v1');
        $this->timeout = env('MESSAGE_SERVICE_TIMEOUT', 30);
    }


    /**
     * Listagem de canais de atendimento
     * @return array
     * @throws Exception
     */
    public function listChannels(): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/channel';

            Log::info('Listando canais de atendimento', [
                'url' => $url
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer pn_2swSS0oxshnjBLlKe2gYz4drFRdhMaJ05QwzHBVIq2o'
            ])
            ->timeout($this->timeout)
            ->get($url);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            }

            throw new Exception('Erro ao listar canais de atendimento: ' . $response->json()['message']);
            
        } catch (Exception $e) {
            throw new Exception('Erro ao listar canais de atendimento: ' . $e->getMessage(), 0, $e  );
        }
    }

    /**
     * Envia uma mensagem de texto
     *
     * @param string $sessionName Nome da sessão
     * @param string $number Número do destinatário (com código do país)
     * @param string $text Texto da mensagem
     * @return array
     * @throws Exception
     */
    public function sendText(string $sessionName, string $number, string $text): array
    {
        try {
            $url = rtrim($this->baseUrl, '/') . '/sendText';

            $payload = [
                'sessionName' => $sessionName,
                'number' => $number,
                'text' => $text
            ];

            Log::info('Enviando mensagem', [
                'url' => $url,
                'payload' => $payload
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($url, $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Mensagem enviada com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data,
                    'message' => 'Mensagem enviada com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao enviar mensagem. Status: ' . $response->status();
                
                Log::error('Erro ao enviar mensagem', [
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
            Log::error('Exceção ao enviar mensagem', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao enviar mensagem: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Valida os parâmetros antes de enviar
     *
     * @param string $sessionName
     * @param string $number
     * @param string $text
     * @return array
     */
    public function validateParams(string $sessionName, string $number, string $text): array
    {
        $errors = [];

        if (empty($sessionName)) {
            $errors[] = 'Nome da sessão é obrigatório';
        }

        if (empty($number)) {
            $errors[] = 'Número do destinatário é obrigatório';
        } elseif (!preg_match('/^\d+$/', $number)) {
            $errors[] = 'Número do destinatário deve conter apenas dígitos';
        }

        if (empty($text)) {
            $errors[] = 'Texto da mensagem é obrigatório';
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    /**
     * Envia mensagem com validação
     *
     * @param string $sessionName
     * @param string $number
     * @param string $text
     * @return array
     * @throws Exception
     */
    public function sendTextWithValidation(string $sessionName, string $number, string $text): array
    {
        $validation = $this->validateParams($sessionName, $number, $text);

        if (!$validation['valid']) {
            return [
                'success' => false,
                'error' => 'Dados inválidos',
                'validation_errors' => $validation['errors']
            ];
        }

        return $this->sendText($sessionName, $number, $text);
    }

    /**
     * Verifica o status de uma sessão
     *
     * @param string $sessionName Nome da sessão
     * @return array
     * @throws Exception
     */
    public function getSessionStatus(string $sessionName): array
    {
        try {
            if (empty($sessionName)) {
                return [
                    'success' => false,
                    'error' => 'Nome da sessão é obrigatório'
                ];
            }

            $url = rtrim($this->baseUrl, '/') . '/status';
            
            Log::info('Verificando status da sessão', [
                'url' => $url,
                'sessionName' => $sessionName
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($url, [
                    'sessionName' => $sessionName
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Status da sessão obtido com sucesso', [
                    'sessionName' => $sessionName,
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data,
                    'sessionName' => $sessionName,
                    'status' => $data['result'] ?? 'UNKNOWN'
                ];
            } else {
                $errorMessage = 'Erro ao verificar status da sessão. Status: ' . $response->status();
                
                Log::error('Erro ao verificar status da sessão', [
                    'sessionName' => $sessionName,
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
            Log::error('Exceção ao verificar status da sessão', [
                'sessionName' => $sessionName,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao verificar status da sessão: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Envia um link com preview
     *
     * @param string $sessionName Nome da sessão
     * @param string $number Número do destinatário (com código do país)
     * @param string $url URL do link
     * @param string $caption Legenda/descrição do link
     * @return array
     * @throws Exception
     */
    public function sendLink(string $sessionName, string $number, string $caption, string $url): array
    {
        try {
            $urlEndpoint = rtrim($this->baseUrl, '/') . '/sendLink';

            $payload = [
                'sessionName' => $sessionName,
                'number' => $number,
                'caption' => $caption,
                'url' => $url
            ];

            Log::info('Enviando link com preview', [
                'url' => $urlEndpoint,
                'payload' => $payload
            ]);

            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($urlEndpoint, $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Link enviado com sucesso', [
                    'response' => $data
                ]);

                return [
                    'success' => true,
                    'data' => $data,
                    'message' => 'Link enviado com sucesso'
                ];
            } else {
                $errorMessage = 'Erro ao enviar link. Status: ' . $response->status();
                
                Log::error('Erro ao enviar link', [
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
            Log::error('Exceção ao enviar link', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new Exception('Erro ao enviar link: ' . $e->getMessage(), 0, $e);
        }
    }
}

