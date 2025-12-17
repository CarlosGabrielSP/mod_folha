<?php

namespace App\Enums;

enum SituacaoEnum: string
{
    case ATIVO = 'ativo';
    case INATIVO = 'inativo';
    case DESLIGADO = 'desligado';
    case APOSENTADO = 'aposentado';

    public function label(): string
    {
        return match($this) {
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
            self::DESLIGADO => 'Desligado',
            self::APOSENTADO => 'Aposentado',
        };
    }
}
