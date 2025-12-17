<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folha extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'folhas';

    protected $keyType = 'string';

    // public $incrementing = false;

    protected $fillable = [
        'id',
        'mes',
        'ano',
    ];

    public function funcionarios()
    {
        return $this->hasMany(RelFolhaFuncionario::class, 'folha_id');
    }

    // Retorna as entidades distintas dos funcionários desta folha
    public function entidades()
    {
        return Entidade::whereHas('funcionarios.folhas', function ($query) {
            $query->where('folhas.id', $this->id);
        })->distinct();
    }
}
