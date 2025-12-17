<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargos';

    protected $fillable = [
        'nome',
        'referencia',
        'carga_horaria',
        'salario_base',
    ];

    public function folhas()
    {
        return $this->hasMany(Folha::class);
    }
}
