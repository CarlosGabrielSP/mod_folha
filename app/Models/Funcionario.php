<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'funcionarios';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'entidade_id',
        'nome',
        'matricula',
        'cpf',
        'cargo_id',
        'data_admissao',
        'data_demissao',
        'email',
        'telefone',
        'id_lotacoes',
        'id_vinculos',
        'id_situacoes',
    ];

    protected $casts = [
        'data_admissao' => 'date',
        'data_demissao' => 'date',
    ];

    // Relationships
    public function entidade()
    {
        return $this->belongsTo(Entidade::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function lotacao()
    {
        return $this->belongsTo(Lotacao::class, 'id_lotacoes');
    }

    public function vinculo()
    {
        return $this->belongsTo(Vinculo::class, 'id_vinculos');
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'id_situacoes');
    }

    public function folhas()
    {
        return $this->hasMany(RelFolhaFuncionario::class, 'funcionario_id');
    }
}
