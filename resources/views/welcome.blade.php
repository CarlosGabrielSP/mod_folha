@extends('layout')

@section('title', 'Folha de Transparência')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Sistema de Folha de Transparência</h1>
            <p class="lead">Consulte informações sobre funcionários e folhas de pagamento</p>

            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Funcionários</h5>
                            <p class="card-text">Consulte a lista de funcionários e suas informações</p>
                            <a href="#" class="btn btn-primary">Ver Funcionários</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Folhas de Pagamento</h5>
                            <p class="card-text">Consulte as folhas de pagamento por período</p>
                            <a href="{{ route('folhas.index') }}" class="btn btn-primary">Ver Folhas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection