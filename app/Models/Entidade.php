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

    public function folhas()
    {
        return $this->hasMany(Folha::class);
    }
}
