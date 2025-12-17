<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelFolhaFuncionario extends Model
{
    use HasFactory;

    protected $table = 'folhas_funcionarios';

    protected $fillable = [
        'folha_id',
        'funcionario_id',
        'referencia',
        'total_proventos',
        'total_descontos',
        'total_liquido',
    ];

    protected $casts = [
        'total_proventos' => 'decimal:2',
        'total_descontos' => 'decimal:2',
        'total_liquido' => 'decimal:2',
    ];

    public function folha()
    {
        return $this->belongsTo(Folha::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function eventos()
    {
        return $this->hasMany(RelFolhaFuncionarioEvento::class, 'folha_item_id');
    }
}
