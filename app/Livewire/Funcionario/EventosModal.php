<?php

namespace App\Livewire\Funcionario;

use App\Models\Funcionario;
use App\Models\RelFolhaFuncionario;
use Livewire\Attributes\On;
use Livewire\Component;

class EventosModal extends Component
{
    public Funcionario $funcionario;

    public RelFolhaFuncionario $despesa;

    #[On('show-modal')]
    public function show(string $funcionario_id, int $relFolhaFuncionario_id): void
    {
        $this->funcionario = Funcionario::findOrFail($funcionario_id);
        $this->despesa = RelFolhaFuncionario::findOrFail($relFolhaFuncionario_id);
    }

    public function render()
    {
        return view('livewire.funcionario.eventos-modal');
    }
}
