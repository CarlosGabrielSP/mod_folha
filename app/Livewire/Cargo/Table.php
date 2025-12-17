<?php

namespace App\Livewire\Cargo;

use App\Models\Cargo;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public array $perPageOptions = [10, 20, 50, 100];

    public string $sortField = 'nome';

    public string $sortDirection = 'asc';

    public int $entidade_id;

    // Filtros
    public string $nome = '';

    public string $referencia = '';

    public string $carga_horaria = '';

    public string $salario_base = '';

    public function mount(int $entidade_id): void
    {
        $this->entidade_id = $entidade_id;
    }

    public function sortBy(string $sortField): void
    {
        $allowedFields = [
            'nome',
            'referencia',
            'carga_horaria',
            'salario_base',
        ];

        if (!in_array($sortField, $allowedFields)) {
            return;
        }

        if ($this->sortField === $sortField) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $sortField;
            $this->sortDirection = 'asc';
        }
    }

    public function getCargos(): LengthAwarePaginator
    {
        $query = Cargo::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereLike('nome', "%{$this->search}%")
                        ->orWhereLike('referencia', "%{$this->search}%");
                });
            })
            ->when($this->nome, function ($query) {
                $query->whereLike('nome', "%{$this->nome}%");
            })
            ->when($this->referencia, function ($query) {
                $query->whereLike('referencia', "%{$this->referencia}%");
            })
            ->when($this->carga_horaria, function ($query) {
                $query->where('carga_horaria', $this->carga_horaria);
            })
            ->when($this->salario_base, function ($query) {
                $query->whereLike('salario_base', "{$this->salario_base}%");
            });

        return $query->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function limparFiltros(): void
    {
        $this->reset([
            'search',
            'nome',
            'referencia',
            'carga_horaria',
            'salario_base',
        ]);
    }

    public function render()
    {
        return view('livewire.cargo.table', [
            'cargos' => $this->getCargos(),
        ]);
    }
}
