<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    use HasFactory;

    protected $table = 'situacoes';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'id_situacoes');
    }
}
