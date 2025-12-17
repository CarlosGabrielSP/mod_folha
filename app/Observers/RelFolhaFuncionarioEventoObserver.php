<?php

namespace App\Observers;

use App\Models\RelFolhaFuncionarioEvento;

class RelFolhaFuncionarioEventoObserver
{
    /**
     * Handle the RelFolhaFuncionarioEvento "created" event.
     */
    public function created(RelFolhaFuncionarioEvento $relFolhaFuncionarioEvento): void
    {
        $this->recalcularTotais($relFolhaFuncionarioEvento);
    }

    /**
     * Handle the RelFolhaFuncionarioEvento "updated" event.
     */
    public function updated(RelFolhaFuncionarioEvento $relFolhaFuncionarioEvento): void
    {
        $this->recalcularTotais($relFolhaFuncionarioEvento);
    }

    /**
     * Handle the RelFolhaFuncionarioEvento "deleted" event.
     */
    public function deleted(RelFolhaFuncionarioEvento $relFolhaFuncionarioEvento): void
    {
        $this->recalcularTotais($relFolhaFuncionarioEvento);
    }

    /**
     * Handle the RelFolhaFuncionarioEvento "restored" event.
     */
    public function restored(RelFolhaFuncionarioEvento $relFolhaFuncionarioEvento): void
    {
        $this->recalcularTotais($relFolhaFuncionarioEvento);
    }

    /**
     * Handle the RelFolhaFuncionarioEvento "force deleted" event.
     */
    public function forceDeleted(RelFolhaFuncionarioEvento $relFolhaFuncionarioEvento): void
    {
        $this->recalcularTotais($relFolhaFuncionarioEvento);
    }

    /**
     * Recalcula os totais da folha do funcionário
     */
    private function recalcularTotais(RelFolhaFuncionarioEvento $relFolhaFuncionarioEvento): void
    {
        $folhaFuncionario = $relFolhaFuncionarioEvento->folhaItem;

        if (! $folhaFuncionario) {
            return;
        }

        // Recarregar os eventos com suas relações
        $folhaFuncionario->load('eventos.evento');

        // Calcular totais
        $total_proventos = $folhaFuncionario->eventos
            ->where('evento.referencia_tipo', 'PROVENTO')
            ->sum('valor');

        $total_descontos = $folhaFuncionario->eventos
            ->where('evento.referencia_tipo', 'DESCONTO')
            ->sum('valor');

        $total_liquido = $total_proventos - $total_descontos;

        // Atualizar sem disparar eventos (para evitar loop infinito)
        $folhaFuncionario->updateQuietly([
            'total_proventos' => $total_proventos,
            'total_descontos' => $total_descontos,
            'total_liquido' => $total_liquido,
        ]);
    }
}
