<?php

use App\Enums\VinculoEnum;
use App\Http\Controllers\FolhaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\RemuneracaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/servidores/1');
});

Route::get('/servidores', [FolhaController::class, 'index'])->name('folhas.index');
Route::get('/servidores/{entidade}', [FolhaController::class, 'show'])->name('folhas.show');

Route::get('/teste', function () {
    $vinculos = VinculoEnum::cases();
    dd($vinculos);
});
