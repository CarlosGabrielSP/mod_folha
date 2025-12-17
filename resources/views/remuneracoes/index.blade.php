@extends('layout')

@section('title', 'Tabela de Remunerações')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Tabela de Remunerações</h1>
    <span class="badge bg-secondary">{{ $remuneracoes->total() }} cargos</span>
</div>

<div class="card mb-4">
    <div class="card-body">
        <p>
            Esta tabela apresenta a estrutura salarial oficial (PCCR). Ela mostra quanto a prefeitura pode pagar para cada cargo, 
            com suas respectivas referências, carga horária e quantidade de servidores atualmente ocupando essas posições.
        </p>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th>Cargo</th>
                <th>Referência/Classe/Nível</th>
                <th>Carga Horária</th>
                <th>Vagas Ocupadas</th>
                <th>Vencimento Base</th>
            </tr>
        </thead>
        <tbody>
            @foreach($remuneracoes as $remuneracao)
            <tr>
                <td class="fw-bold">{{ $remuneracao->nome }}</td>
                <td>{{ $remuneracao->referencia ?? '-' }}</td>
                <td>{{ $remuneracao->carga_horaria ?? '-' }}</td>
                <td>
                    <span class="badge bg-info">{{ $remuneracao->quantidade }}</span>
                </td>
                <td>
                    @if($remuneracao->salario_base)
                        R$ {{ number_format($remuneracao->salario_base, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $remuneracoes->links() }}

<div class="card mt-4">
    <div class="card-header bg-info text-white">
        Informações Adicionais
    </div>
    <div class="card-body">
        <p class="mb-0">
            <strong>Observação:</strong> Esta tabela representa a estrutura de remuneração oficial e não necessariamente 
            o salário exato de uma pessoa específica, que pode variar com base em adicionais, gratificações e outros fatores.
        </p>
    </div>
</div>
@endsection
