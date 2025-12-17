<?php

namespace App\Livewire\Funcionario;

use App\Models\RelFolhaFuncionario;
use Livewire\Component;

class EventosTable extends Component
{
    public int $despesa_id;

    public string $filter = 'todos'; // todos, proventos, descontos

    public function mount(int $despesa_id): void
    {
        $this->despesa_id = $despesa_id;
    }

    public function render()
    {
        $despesa = RelFolhaFuncionario::with(['eventos.evento'])
            ->findOrFail($this->despesa_id);

        $eventos = $despesa->eventos;

        // Aplicar filtro
        if ($this->filter === 'proventos') {
            $eventos = $eventos->filter(fn ($item) => $item->evento->referencia_tipo === 'PROVENTO');
        } elseif ($this->filter === 'descontos') {
            $eventos = $eventos->filter(fn ($item) => $item->evento->referencia_tipo === 'DESCONTO');
        }

        // Separar e calcular totais
        $proventos = $eventos->filter(fn ($item) => $item->evento->referencia_tipo === 'PROVENTO');
        $descontos = $eventos->filter(fn ($item) => $item->evento->referencia_tipo === 'DESCONTO');

        $total_proventos = $proventos->sum('valor');
        $total_descontos = $descontos->sum('valor');
        $total_liquido = $total_proventos - $total_descontos;

        return view('livewire.funcionario.eventos-table', [
            'eventos' => $eventos,
            'proventos' => $proventos,
            'descontos' => $descontos,
            'total_proventos' => $total_proventos,
            'total_descontos' => $total_descontos,
            'total_liquido' => $total_liquido,
        ]);
    }
}
