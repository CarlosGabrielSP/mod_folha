<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\FolhaController;
use App\Models\Entidade;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $entidade = Entidade::first();
    if (!$entidade) abort(404);
    return redirect("{$entidade->slug}/servidores");
})->name('home');

Route::get('/servidores', function () {
    $entidade = Entidade::first();
    if (!$entidade) abort(404);
    return redirect("{$entidade->slug}/servidores");
})->name('folhas.index');

Route::get('{slug}/servidores', [FolhaController::class, 'show'])->name('folhas.show');

Route::get('/remuneracoes', function () {
    $entidade = Entidade::first();
    if (!$entidade) abort(404);
    return redirect("{$entidade->slug}/remuneracoes");
})->name('cargos.index');

Route::get('{slug}/remuneracoes', [CargoController::class, 'index'])->name('cargos.index');