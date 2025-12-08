<?php

namespace App\Console\Commands;

use App\Jobs\NotificarAgendamentosJob;
use Illuminate\Console\Command;

class TestNotificarAgendamentos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agendamentos:notificar {--sync : Executa de forma síncrona}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa o job de notificação de agendamentos do dia posterior';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando teste de notificação de agendamentos...');

        $job = new NotificarAgendamentosJob();

        if ($this->option('sync')) {
            $this->info('Executando de forma síncrona...');
            $job->handle();
            $this->info('Processamento concluído!');
        } else {
            $this->info('Despachando job para a fila...');
            dispatch($job);
            $this->info('Job despachado! Verifique os logs para acompanhar o processamento.');
        }

        return Command::SUCCESS;
    }
}
