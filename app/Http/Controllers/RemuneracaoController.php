<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Support\Facades\DB;

class RemuneracaoController extends Controller
{
    public function index()
    {
        // Busca todos os cargos e conta quantos funcionários estão em cada cargo
        $remuneracoes = Cargo::select([
            'cargos.*',
            DB::raw('COUNT(funcionarios.id) as quantidade'),
        ])
            ->leftJoin('funcionarios', 'funcionarios.cargo_id', '=', 'cargos.id')
            ->groupBy('cargos.id')
            ->orderBy('cargos.nome')
            ->paginate(20);

        return view('remuneracoes.index', compact('remuneracoes'));
    }
}
