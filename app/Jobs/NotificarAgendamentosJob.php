<?php

namespace App\Jobs;

use App\Services\AtegencService;
use App\Services\MessageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

class NotificarAgendamentosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var AtegencService
     */
    private $ategencService;

    /**
     * @var MessageService
     */
    private $messageService;

    /**
     * Nome da sessão do WhatsApp
     *
     * @var string
     */
    private $sessionName;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->ategencService = app(AtegencService::class);
        $this->messageService = app(MessageService::class);
        $this->sessionName = env('WHATSAPP_SESSION_NAME', 'fabio');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Iniciando verificação de agendamentos para o dia posterior');

            // Data do dia posterior
            $dataProximoDia = Carbon::tomorrow()->format('Y-m-d');
            $dataProximoDiaFormatada = Carbon::tomorrow()->format('d/m/Y');

            Log::info('Buscando agendamentos para: ' . $dataProximoDia);

            // Buscar todos os agendamentos com detalhes
            $offset = 0;
            $limit = 100;
            $totalProcessados = 0;
            $totalEnviados = 0;
            $totalErros = 0;

            do {
                $result = $this->ategencService->getAllDetalhes($limit, $offset);

                if (!$result['success'] || empty($result['data'])) {
                    Log::warning('Nenhum agendamento encontrado ou erro na busca', [
                        'offset' => $offset,
                        'result' => $result
                    ]);
                    break;
                }

                $agendamentos = $result['data'];
                $agendamentosFiltrados = $this->filtrarAgendamentosPorData($agendamentos, $dataProximoDia);

                foreach ($agendamentosFiltrados as $item) {
                    $totalProcessados++;

                    try {
                        $this->enviarNotificacao($item, $dataProximoDiaFormatada);
                        $totalEnviados++;
                    } catch (Exception $e) {
                        $totalErros++;
                        Log::error('Erro ao enviar notificação para agendamento', [
                            'agendamento' => $item,
                            'error' => $e->getMessage()
                        ]);
                    }
                }

                $offset += $limit;

                // Verifica se há mais registros
                $pagination = $result['pagination'] ?? [];
                $total = $pagination['total'] ?? 0;

            } while ($offset < $total);

            Log::info('Processamento de agendamentos concluído', [
                'data' => $dataProximoDiaFormatada,
                'total_processados' => $totalProcessados,
                'total_enviados' => $totalEnviados,
                'total_erros' => $totalErros
            ]);

        } catch (Exception $e) {
            Log::error('Erro ao processar agendamentos', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    /**
     * Filtra agendamentos para o dia especificado
     *
     * @param array $agendamentos
     * @param string $dataBusca (formato Y-m-d)
     * @return array
     */
    private function filtrarAgendamentosPorData(array $agendamentos, string $dataBusca): array
    {
        $filtrados = [];

        foreach ($agendamentos as $item) {
            // Verifica se os dados vêm estruturados
            $agendamento = $item['agendamento'] ?? $item;

            // Tenta diferentes campos de data comuns
            $dataAgendamento = null;
            $camposData = ['DDATAGENC', 'DDATACONSU', 'DDATAAGENC', 'DDATA', 'DATA', 'DTAGENDAMENTO'];

            foreach ($camposData as $campo) {
                if (isset($agendamento[$campo])) {
                    $dataAgendamento = $agendamento[$campo];
                    break;
                }
            }

            if (!$dataAgendamento) {
                Log::warning('Campo de data não encontrado no agendamento', [
                    'agendamento' => $agendamento
                ]);
                continue;
            }

            // Normaliza a data para comparação
            try {
                $dataNormalizada = $this->normalizarData($dataAgendamento);
                
                if ($dataNormalizada && $dataNormalizada->format('Y-m-d') === $dataBusca) {
                    $filtrados[] = $item;
                }
            } catch (Exception $e) {
                Log::warning('Erro ao normalizar data do agendamento', [
                    'data' => $dataAgendamento,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return $filtrados;
    }

    /**
     * Normaliza diferentes formatos de data
     *
     * @param mixed $data
     * @return Carbon|null
     */
    private function normalizarData($data): ?Carbon
    {
        if (empty($data)) {
            return null;
        }

        // Se já for um objeto Carbon/DateTime
        if ($data instanceof Carbon) {
            return $data;
        }

        if ($data instanceof \DateTime) {
            return Carbon::instance($data);
        }

        // Tenta diferentes formatos
        $formatos = [
            'Y-m-d',
            'Y-m-d H:i:s',
            'd/m/Y',
            'd/m/Y H:i:s',
            'd-m-Y',
            'Ymd',
            'dmY'
        ];

        foreach ($formatos as $formato) {
            try {
                $carbon = Carbon::createFromFormat($formato, $data);
                if ($carbon) {
                    return $carbon;
                }
            } catch (Exception $e) {
                continue;
            }
        }

        // Tenta parse genérico
        try {
            return Carbon::parse($data);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Envia notificação de agendamento
     *
     * @param array $item
     * @param string $dataFormatada
     * @return void
     * @throws Exception
     */
    private function enviarNotificacao(array $item, string $dataFormatada): void
    {
        // Extrai dados estruturados ou planos
        $agendamento = $item['agendamento'] ?? $item;
        $consulta = $item['consulta'] ?? [];
        $paciente = $item['paciente'] ?? [];

        // Obtém informações do paciente
        $nomePaciente = $paciente['CNOMEPACIE'] ?? $agendamento['CNOMEPACIE'] ?? 'Paciente';
        $telefone = $paciente['CFCELPACIE'] ?? $paciente['CFONEPACIE'] ?? $agendamento['CFCELPACIE'] ?? $agendamento['CFONEPACIE'] ?? null;

        if (empty($telefone)) {
            Log::warning('Telefone não encontrado para o paciente', [
                'paciente' => $nomePaciente,
                'agendamento' => $agendamento
            ]);
            return;
        }

        // Obtém informações da consulta
        $nomeConsulta = $consulta['CNOMECONSU'] ?? $agendamento['CNOMECONSU'] ?? 'Consulta';
        $tipoConsulta = $consulta['CTIPOCONSU'] ?? $agendamento['CTIPOCONSU'] ?? '';
        $especialidade = $consulta['NNUMEESPEC'] ?? $agendamento['NNUMEESPEC'] ?? '';

        // Obtém horário do agendamento
        $horario = $agendamento['CHORAAGENC'] ?? 'Agendamento a confirmar';

        // Obtém ID do agendamento para o link
        $idAgendamento = $agendamento['NAGENAGENC'] ?? $agendamento['NNUMEGENC'] ?? null;

        // Formata o número do telefone (remove caracteres não numéricos)
        $numeroLimpo = preg_replace('/[^0-9]/', '', $telefone);

        // Se não tiver código do país, adiciona (assumindo Brasil - 55)
        if (strlen($numeroLimpo) <= 11) {
            $numeroLimpo = '55' . $numeroLimpo;
        }

        // Monta a mensagem base (sem o link) 
        $mensagem = $this->montarMensagem($nomePaciente, $nomeConsulta, $tipoConsulta, $dataFormatada, $horario);

        Log::info('Enviando notificação de agendamento', [
            'paciente' => $nomePaciente,
            'telefone' => $numeroLimpo,
            'data' => $dataFormatada,
            'horario' => $horario,
            'idAgendamento' => $idAgendamento
        ]);

        $idAgendamento = 1;

        // Se houver ID do agendamento, envia o link com preview
        if ($idAgendamento) {
            // $urlConfirmacao = url("/agendamentos/confirmar/{$idAgendamento}");
            $urlConfirmacao = "https://bioshild.com.br";
            
            // Envia o link com preview usando a mensagem como caption
            $result = $this->messageService->sendLink(
                $this->sessionName,
                $numeroLimpo,
                $urlConfirmacao,
                $mensagem
            );

            if (!$result['success']) {
                throw new Exception('Erro ao enviar link: ' . ($result['error'] ?? 'Erro desconhecido'));
            }

            Log::info('Link com preview enviado com sucesso', [
                'paciente' => $nomePaciente,
                'telefone' => $numeroLimpo,
                'url' => $urlConfirmacao
            ]);
        } else {
            // Se não houver link, envia apenas a mensagem de texto
            $result = $this->messageService->sendText($this->sessionName, $numeroLimpo, $mensagem);

            if (!$result['success']) {
                throw new Exception('Erro ao enviar mensagem: ' . ($result['error'] ?? 'Erro desconhecido'));
            }

            Log::info('Notificação enviada com sucesso', [
                'paciente' => $nomePaciente,
                'telefone' => $numeroLimpo
            ]);
        }
    }

    /**
     * Obtém o horário do agendamento
     *
     * @param array $agendamento
     * @return string
     */
    private function obterHorarioAgendamento(array $agendamento): string
    {
        $camposHorario = ['HHORAGENC', 'HHORACONSU', 'HORA', 'HORARIO', 'HHORA'];

        foreach ($camposHorario as $campo) {
            if (isset($agendamento[$campo]) && !empty($agendamento[$campo])) {
                $horario = $agendamento[$campo];
                // Tenta formatar o horário
                try {
                    if (strlen($horario) == 4) {
                        // Formato HHMM
                        return substr($horario, 0, 2) . ':' . substr($horario, 2, 2);
                    } elseif (strlen($horario) == 6) {
                        // Formato HHMMSS
                        return substr($horario, 0, 2) . ':' . substr($horario, 2, 2);
                    } else {
                        return $horario;
                    }
                } catch (Exception $e) {
                    return $horario;
                }
            }
        }

        return 'Horário a confirmar';
    }

    /**
     * Monta a mensagem de notificação (sem o link, que será enviado separadamente)
     *
     * @param string $nomePaciente
     * @param string $nomeConsulta
     * @param string $tipoConsulta
     * @param string $dataFormatada
     * @param string $horario
     * @return string
     */
    private function montarMensagem(
        string $nomePaciente,
        string $nomeConsulta,
        string $tipoConsulta,
        string $dataFormatada,
        string $horario
    ): string {
        $mensagem = "Olá, {$nomePaciente}!\n\n";
        $mensagem .= "📅 Lembrete de Agendamento\n\n";
        $mensagem .= "Você tem uma consulta agendada para:\n";
        $mensagem .= "📆 Data: {$dataFormatada}\n";
        $mensagem .= "🕐 Horário: {$horario}\n";
        $mensagem .= "\n🔗 Clique no link abaixo para confirmar sua presença:\n";
        $mensagem .= "\nPor favor, confirme sua presença ou entre em contato caso precise reagendar.\n\n";
        $mensagem .= "Atenciosamente,\nEquipe de Atendimento";

        return $mensagem;
    }
}

