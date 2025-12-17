<?php

namespace App\Livewire\Folha;

use App\Enums\SituacaoEnum;
use App\Enums\VinculoEnum;
use App\Enums\ReferenciaFolhaEnum;
use App\Models\Cargo;
use App\Models\Folha;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public string $mes_ano = '2025-01';

    public string $search = '';

    public int $perPage = 10;

    public array $perPageOptions = [10, 20, 50, 100, 200, 500];

    public string $sortField = 'funcionario';

    public string $sortDirection = 'asc';

    public int $entidade_id;

    public float $total_descontos = 0;
    
    public float $total_proventos = 0;
    
    public float $total_liquido = 0;
    
    public array $referenciasFolha = [];

    public array $vinculos = [];
    
    public array $cargos = [];
    
    public array $situacoes = [];

    // Filtros
    public string $matricula = '';

    public string $nome = '';

    public string $vinculo = '';

    public string $cargo = '';

    public string $situacao = '';

    public string $lotacao = '';

    public string $proventos = '';

    public string $descontos = '';

    public string $liquido = '';


    public function mount(int $entidade_id): void
    {
        $this->entidade_id = $entidade_id;

        $this->cargos = Cargo::all()->pluck('nome', 'id')->toArray();
        $this->vinculos = VinculoEnum::cases();
        $this->situacoes = SituacaoEnum::cases();
        $this->referenciasFolha = ReferenciaFolhaEnum::cases();
    }

    public function sortBy(string $sortField): void
    {
        $allowedFields = [
            'matricula',
            'funcionario',
            'vinculo',
            'lotacao',
            'situacao',
            'total_proventos',
            'total_descontos',
            'total_liquido',
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

    public function FolhaFuncionario(): LengthAwarePaginator|Collection
    {
        if (! $this->entidade_id || ! $this->mes_ano) {
            return collect([]);
        }

        $query = Folha::with(['entidade', 'cargo'])
        ->where('entidade_id', $this->entidade_id)
        ->where('mes', explode('-', $this->mes_ano)[1])
        ->where('ano', explode('-', $this->mes_ano)[0])
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->whereLike('funcionario', "%{$this->search}%")
                    ->orWhereLike('matricula', "%{$this->search}%")
                    ->orWhereLike('vinculo', "%{$this->search}%")
                    ->orWhereLike('lotacao', "%{$this->search}%")
                    ->orWhereLike('situacao', "%{$this->search}%")
                    ->orWhereHas('cargo', function ($query) {
                        $query->whereLike('nome', "%{$this->search}%");
                    });
            });
        })
        ->when($this->matricula, function ($query) {
            $query->whereLike('matricula', "%{$this->matricula}%");
        })
        ->when($this->nome, function ($query) {
            $query->whereLike('funcionario', "%{$this->nome}%");
        })
        ->when($this->cargo, function ($query) {
            $query->where('cargo_id', $this->cargo);
        })
        ->when($this->vinculo, function ($query) {
            $query->where('vinculo', $this->vinculo);
        })
        ->when($this->lotacao, function ($query) {
            $query->whereLike('lotacao', "%{$this->lotacao}%");
        })
        ->when($this->situacao, function ($query) {
            $query->where('situacao', $this->situacao);
        })
        ->when($this->proventos, function ($query) {
            $query->whereLike('total_proventos', "{$this->proventos}%");
        })
        ->when($this->descontos, function ($query) {
            $query->whereLike('total_descontos', "{$this->descontos}%");
        })
        ->when($this->liquido, function ($query) {
            $query->whereLike('total_liquido', "{$this->liquido}%");
        });

        $this->total_descontos = $query->sum('total_descontos');
        $this->total_proventos = $query->sum('total_proventos');
        $this->total_liquido = $query->sum('total_liquido');

        return $query->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function limparFiltros(): void
    {
        $this->reset([
            'search',
            'matricula',
            'nome',
            'vinculo',
            'cargo',
            'lotacao',
            'situacao',
            'proventos',
            'descontos',
            'liquido'
        ]);
    }

    public function render()
    {
        return view('livewire.folha.table', [
            'despesas' => $this->FolhaFuncionario(),
        ]);
    }
}

