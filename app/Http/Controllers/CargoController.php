<?php

namespace App\Http\Controllers;

use App\Models\Entidade;

class CargoController extends Controller
{
    public function index(string $slug)
    {
        $entidade = Entidade::where('slug', $slug)->firstOrFail();
        return view('pages.cargos.index', compact('entidade'));
    }
}
