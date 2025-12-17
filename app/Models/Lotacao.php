<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    use HasFactory;

    protected $table = 'lotacoes';

    protected $fillable = [
        'nome',
        'codigo',
        'endereco',
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'id_lotacoes');
    }
}
