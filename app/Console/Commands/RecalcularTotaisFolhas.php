<?php

namespace App\Console\Commands;

use App\Models\RelFolhaFuncionario;
use Illuminate\Console\Command;

class RecalcularTotaisFolhas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folhas:recalcular-totais';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalcula os totais de proventos, descontos e líquido de todas as folhas baseado nos eventos cadastrados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando recálculo dos totais...');

        $folhas = RelFolhaFuncionario::with('eventos.evento')->get();
        $bar = $this->output->createProgressBar($folhas->count());
        $bar->start();

        $atualizados = 0;

        foreach ($folhas as $folha) {
            // Calcular totais
            $total_proventos = $folha->eventos
                ->where('evento.referencia_tipo', 'PROVENTO')
                ->sum('valor');

            $total_descontos = $folha->eventos
                ->where('evento.referencia_tipo', 'DESCONTO')
                ->sum('valor');

            $total_liquido = $total_proventos - $total_descontos;

            // Atualizar sem disparar eventos
            $folha->updateQuietly([
                'total_proventos' => $total_proventos,
                'total_descontos' => $total_descontos,
                'total_liquido' => $total_liquido,
            ]);

            $atualizados++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("✓ {$atualizados} folhas atualizadas com sucesso!");

        return Command::SUCCESS;
    }
}
