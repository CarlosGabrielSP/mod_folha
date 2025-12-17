<?php

namespace App\Livewire\Folha;

use App\Models\Cargo;
use App\Models\Lotacao;
use App\Models\RelFolhaFuncionario;
use App\Models\Situacao;
use App\Models\Vinculo;
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

    public string $sortField = 'funcionarios.nome';

    public string $sortDirection = 'asc';

    public int $entidade_id;

    public float $total_descontos = 0;

    public float $total_proventos = 0;

    public float $total_liquido = 0;

    public Collection $vinculos;

    public Collection $cargos;

    public Collection $lotacoes;

    public Collection $situacoes;

    // Filtros
    public string $matricula = '';

    public string $nome = '';

    public string $vinculo = '';

    public string $cargo = '';

    public string $lotacao = '';

    public string $situacao = '';

    public string $proventos = '';

    public string $descontos = '';

    public string $liquido = '';

    public function modal(): void
    {
        $this->js("console.log('modal');");
    }

    public function mount(int $entidade_id): void
    {
        $this->entidade_id = $entidade_id;

        $this->vinculos = Vinculo::all();
        $this->cargos = Cargo::all();
        $this->lotacoes = Lotacao::all();
        $this->situacoes = Situacao::all();
    }

    public function sortBy(string $sortField): void
    {
        // Campos permitidos para ordenação
        $allowedFields = [
            'funcionarios.nome',
            'funcionarios.matricula',
            'folhas.mes',
            'folhas.ano',
            'cargos.nome',
            'vinculos.nome',
            'lotacoes.nome',
            'situacoes.nome',
            'total_proventos',
            'total_descontos',
            'total_liquido',
        ];

        if (! in_array($sortField, $allowedFields)) {
            return; // Ignora campos não permitidos
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

        $query = RelFolhaFuncionario::with([
            'folha',
            'funcionario',
            'funcionario.entidade',
            'funcionario.cargo',
            'funcionario.lotacao',
            'funcionario.vinculo',
            'funcionario.situacao',
        ])
            ->join('funcionarios', 'folhas_funcionarios.funcionario_id', '=', 'funcionarios.id')
            ->leftJoin('cargos', 'funcionarios.cargo_id', '=', 'cargos.id')
            ->leftJoin('vinculos', 'funcionarios.id_vinculos', '=', 'vinculos.id')
            ->leftJoin('lotacoes', 'funcionarios.id_lotacoes', '=', 'lotacoes.id')
            ->leftJoin('situacoes', 'funcionarios.id_situacoes', '=', 'situacoes.id')
            ->where('funcionarios.entidade_id', $this->entidade_id)
            ->when($this->mes_ano, function ($query) {
                $data = explode('-', $this->mes_ano);
                $query->join('folhas', 'folhas_funcionarios.folha_id', '=', 'folhas.id')
                    ->where('folhas.ano', $data[0])
                    ->where('folhas.mes', $data[1]);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('funcionarios.nome', 'like', "%{$this->search}%")
                        ->orWhereHas('funcionario.cargo', function ($query) {
                            $query->whereLike('nome', "%{$this->search}%");
                        })
                        ->orWhereHas('funcionario.lotacao', function ($query) {
                            $query->whereLike('nome', "%{$this->search}%");
                        })
                        ->orWhereHas('funcionario.vinculo', function ($query) {
                            $query->whereLike('nome', "%{$this->search}%");
                        })
                        ->orWhereHas('funcionario.situacao', function ($query) {
                            $query->whereLike('nome', "%{$this->search}%");
                        });
                });
            })
            ->when($this->matricula, function ($query) {
                $query->whereLike('funcionarios.matricula', "%{$this->matricula}%");
            })
            ->when($this->nome, function ($query) {
                $query->whereLike('funcionarios.nome', "%{$this->nome}%");
            })
            ->when($this->vinculo, function ($query) {
                $query->where('funcionarios.id_vinculos', $this->vinculo);
            })
            ->when($this->cargo, function ($query) {
                $query->where('funcionarios.id_cargos', $this->cargo);
            })
            ->when($this->lotacao, function ($query) {
                $query->where('funcionarios.id_lotacoes', $this->lotacao);
            })
            ->when($this->situacao, function ($query) {
                $query->where('funcionarios.id_situacoes', $this->situacao);
            })
            ->when($this->proventos, function ($query) {
                $query->whereLike('total_proventos', "{$this->proventos}%");
            })
            ->when($this->descontos, function ($query) {
                $query->whereLike('total_descontos', "{$this->descontos}%");
            })
            ->when($this->liquido, function ($query) {
                $query->whereLike('total_liquido', "{$this->liquido}%");
            })
            ->select('folhas_funcionarios.*');

        $this->total_descontos = $query->sum('total_descontos');
        $this->total_proventos = $query->sum('total_proventos');
        $this->total_liquido = $query->sum('total_liquido');

        return $query->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function limparFiltros(): void
    {
        $this->reset(['search', 'matricula', 'nome', 'vinculo', 'cargo', 'lotacao', 'situacao', 'proventos', 'descontos', 'liquido']);
    }

    public function render()
    {
        return view('livewire.folha.table', [
            'despesas' => $this->FolhaFuncionario(),
        ]);
    }
}
