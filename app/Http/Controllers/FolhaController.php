<?php

namespace App\Http\Controllers;

use App\Models\Entidade;

class FolhaController extends Controller
{
    public function show(Entidade $entidade)
    {
        return view('pages.folhas.index', compact('entidade'));
    }
}
