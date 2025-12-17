<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    use HasFactory;

    protected $table = 'vinculos';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'id_vinculos');
    }
}
