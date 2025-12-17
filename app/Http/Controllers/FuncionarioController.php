<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\RelFolhaFuncionario;

class FuncionarioController extends Controller
{
    public function show(Funcionario $funcionario, RelFolhaFuncionario $despesa)
    {
        // Validar que a despesa pertence ao funcionário
        if ($despesa->funcionario_id !== $funcionario->id) {
            abort(404);
        }

        // Carregar relações necessárias
        $funcionario->load([
            'entidade',
            'cargo',
            'lotacao',
            'vinculo',
            'situacao',
        ]);

        $despesa->load([
            'folha',
            'eventos.evento',
        ]);

        return view('pages.funcionarios.show', compact('funcionario', 'despesa'));
    }
}
