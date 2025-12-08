<?php

namespace App\Console;

use App\Jobs\NotificarAgendamentosJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Executa o job de notificação de agendamentos todos os dias às 08:00
        $schedule->job(new NotificarAgendamentosJob())
            ->dailyAt('08:00')
            ->timezone('America/Sao_Paulo')
            ->withoutOverlapping()
            ->onFailure(function () {
                \Log::error('Falha ao executar job de notificação de agendamentos');
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
