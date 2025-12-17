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

    public $timestamps = false;

    protected $fillable = [
        'id',
        'mes',
        'ano',
        'referencia',
        'matricula',
        'funcionario',
        'situacao',
        'lotacao',
        'vinculo',
        'total_proventos',
        'total_descontos',
        'total_liquido',
        'cargo_id',
        'entidade_id',
    ];

    protected $casts = [
        'referencia' => \App\Enums\ReferenciaFolhaEnum::class,
        'situacao' => \App\Enums\SituacaoEnum::class,
        'vinculo' => \App\Enums\VinculoEnum::class,
        'total_proventos' => 'decimal:2',
        'total_descontos' => 'decimal:2',
        'total_liquido' => 'decimal:2',
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function entidade()
    {
        return $this->belongsTo(Entidade::class);
    }
}
