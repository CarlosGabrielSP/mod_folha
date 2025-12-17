<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Entidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'slug',
        'cnpj',
        'uf',
        'municipio',
        'cep',
        'logradouro',
        'bairro',
        'telefone',
        'email',
        'site',
        'logo',
    ];

    public function slug(): Attribute
    {
        return new Attribute(
            set: fn () => Str::slug($this->nome)
        );
    }

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class);
    }

    // Retorna as folhas que contêm funcionários desta entidade
    public function folhas()
    {
        return Folha::whereHas('funcionarios.funcionario', function ($query) {
            $query->where('entidade_id', $this->id);
        })->distinct();
    }
}
