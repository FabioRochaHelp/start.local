<?php

namespace App\Http\Controllers;

use App\Http\Requests\AteflateRequest;
use App\Services\AteflateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AteflateController extends Controller
{
    private AteflateService $ateflateService;

    public function __construct(AteflateService $ateflateService)
    {
        $this->ateflateService = $ateflateService;
    }

    /**
     * Exibe formulário de confirmação
     */
    public function showConfirmacao($id)
    {
        try {
            // Buscar dados do agendamento
            $agendamento = $this->buscarAgendamento($id);
            
            if (!$agendamento) {
                return redirect()->route('home')
                    ->with('toast_type', 'error')
                    ->with('toast_message', 'Agendamento não encontrado.');
            }

            return view('confirmar-agendamento', [
                'agendamento' => $agendamento,
                'id' => $id
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao carregar confirmação', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('home')
                ->with('toast_type', 'error')
                ->with('toast_message', 'Erro ao carregar agendamento.');
        }
    }

    /**
     * Processa a confirmação/cancelamento
     */
    public function processar(AteflateRequest $request)
    {
        DB::beginTransaction();
        
        try {
            Log::info('Iniciando processamento de agendamento', [
                'acao' => $request->acao,
                'agendamento_id' => $request->agendamento_id
            ]);

            // 1. Validar dados (já feito pelo AteflateRequest)
            $dadosValidados = $request->validated();
            
            // 2. Preparar dados para API
            $payload = $this->ateflateService->prepararDados($dadosValidados);
            
            // 3. Enviar para API
            $respostaApi = $this->ateflateService->enviarParaApi($payload);
            
            // 4. Validar resposta da API
            if (!$this->ateflateService->validarRespostaApi($respostaApi['data'])) {
                throw new \Exception('Resposta inválida da API');
            }
            
            // 5. Atualizar status local do agendamento (se necessário)
            $this->atualizarAgendamentoLocal(
                $request->agendamento_id, 
                $request->acao,
                $respostaApi['data']['nnumeflate'] ?? null
            );
            
            DB::commit();
            
            Log::info('Agendamento processado com sucesso', [
                'agendamento_id' => $request->agendamento_id,
                'acao' => $request->acao,
                'registro_id' => $respostaApi['data']['nnumeflate'] ?? null
            ]);

            // 6. Redirecionar com mensagem de sucesso
            return $this->redirecionarSucesso($request->acao);

        } catch (\App\Exceptions\ApiException $e) {
            DB::rollBack();
            
            Log::error('Erro da API ao processar agendamento', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'agendamento_id' => $request->agendamento_id ?? 'N/A'
            ]);
            
            // Tentar fallback local
            try {
                $fallbackResult = $this->ateflateService->fallbackLocal(
                    $this->ateflateService->prepararDados($request->validated())
                );
                
                return redirect()->route('ateflate.confirmacao.sucesso')
                    ->with('toast_type', 'warning')
                    ->with('toast_message', 'Agendamento registrado localmente. Será processado em breve.');
                    
            } catch (\Exception $fallbackError) {
                return $this->redirecionarErro($e->getMessage());
            }

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erro ao processar agendamento', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'agendamento_id' => $request->agendamento_id ?? 'N/A'
            ]);

            return $this->redirecionarErro('Erro interno ao processar solicitação.');
        }
    }

    /**
     * Busca dados do agendamento (método protegido)
     */
    private function buscarAgendamento($id): ?array
    {
        // Implemente a lógica real de busca do agendamento
        // Exemplo com query ao banco:
        /*
        $agendamento = DB::table('agendamentos')
            ->where('id', $id)
            ->first();
            
        $consulta = DB::table('consultas')
            ->where('id', $agendamento->consulta_id)
            ->first();
            
        $paciente = DB::table('pacientes')
            ->where('id', $agendamento->paciente_id)
            ->first();
            
        return [
            'agendamento' => $agendamento,
            'consulta' => $consulta,
            'paciente' => $paciente
        ];
        */
        
        // Exemplo mock para teste
        return [
            'agendamento' => [
                'NNUMEAGENC' => $id,
                'NNUMEAGEND' => rand(1000, 9999),
                'DDATAAGENC' => now()->format('Y-m-d'),
                'CHORAAGENC' => '14:30',
                'CSITUAGENC' => 'Pendente'
            ],
            'consulta' => [
                'CNOMECONSU' => 'Consulta de Rotina',
                'CTIPOCONSU' => 'Presencial'
            ],
            'paciente' => [
                'CNOMEPACIE' => 'João da Silva',
                'CCPFCPACIE' => '123.456.789-00',
                'CFCELPACIE' => '(11) 99999-9999'
            ]
        ];
    }

    /**
     * Atualiza agendamento localmente
     */
    private function atualizarAgendamentoLocal($agendamentoId, $acao, $registroId = null): void
    {
        // Implemente a lógica real de atualização
        // Exemplo:
        /*
        DB::table('agendamentos')
            ->where('id', $agendamentoId)
            ->update([
                'status' => $acao === 'confirmar' ? 'Confirmado' : 'Cancelado',
                'data_confirmacao' => now(),
                'registro_externo_id' => $registroId,
                'updated_at' => now()
            ]);
        */
        
        Log::info('Agendamento local atualizado', [
            'id' => $agendamentoId,
            'acao' => $acao,
            'registro_id' => $registroId
        ]);
    }

    /**
     * Redireciona para página de sucesso
     */
    private function redirecionarSucesso(string $acao)
    {
        $mensagens = [
            'confirmar' => 'Agendamento confirmado com sucesso!',
            'cancelar' => 'Agendamento cancelado com sucesso!'
        ];

        return redirect()->route('ateflate.confirmacao.sucesso')
            ->with('toast_type', 'success')
            ->with('toast_message', $mensagens[$acao] ?? 'Operação realizada com sucesso!')
            ->with('acao', $acao);
    }

    /**
     * Redireciona para página de erro
     */
    private function redirecionarErro(string $mensagem)
    {
        return back()
            ->withInput()
            ->with('toast_type', 'error')
            ->with('toast_message', $mensagem);
    }

    /**
     * Página de sucesso
     */ 
    public function sucesso( Request $request)
    {
        return view('confirmacao-sucesso', [
            'acao' => $request->acao ?? 'N/A',
            'id' => $request->id ?? 'N/A'
        ]);
    }

    /**
     * Endpoint para health check da API
     */
    public function healthCheck()
    {
        try {
            $response = Http::timeout(5)
                ->get(config('services.ateflate_api.url') . '/health');
                
            return response()->json([
                'api_status' => $response->successful() ? 'online' : 'offline',
                'api_response' => $response->json(),
                'timestamp' => now()->toISOString()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'api_status' => 'offline',
                'error' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 503);
        }
    }
}