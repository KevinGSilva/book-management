<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpa registros de logs do sistema com mais de 30 dias.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando limpeza de logs...');

        try {
            $count = Activity::where('created_at', '<=', now()->subDays(30))->count();
    
            if ($count === 0) {
                \Log::channel('clear-logs')->info('Nenhum registro de log encontrado para limpeza.');
                $this->info('Nenhum registro de log encontrado para limpeza.');
                return;
            }
            
            Activity::where('created_at', '<=', now()->subDays(30))->delete();
    
            \Log::channel('clear-logs')->info("Foram excluídos {$count} registros de log.");
    
            $this->info("Limpeza de logs concluída. Total de registros removidos: {$count}");
        } catch (\Exception $e) {
            \Log::channel('clear-logs')->error('Erro ao limpar logs: ' . $e->getMessage());
        }
    }
}
