<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelFolhaFuncionarioEvento extends Model
{
    use HasFactory;

    protected $table = 'folhas_funcionarios_eventos';

    protected $fillable = [
        'folha_item_id',
        'evento_id',
        'valor',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    public function folhaItem()
    {
        return $this->belongsTo(RelFolhaFuncionario::class, 'folha_item_id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
