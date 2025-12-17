<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'nome',
        'referencia_tipo',
    ];

    public function itens()
    {
        return $this->hasMany(RelFolhaFuncionarioEvento::class);
    }
}
