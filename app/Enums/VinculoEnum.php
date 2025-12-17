<?php

namespace App\Enums;

enum VinculoEnum: string
{
    case ESTATUTARIO = 'estatutario';
    case COMISSIONADO = 'comissionado';
    case CONTRATADO = 'contratado';
    case TEMPORARIO = 'temporario';
    case ESTAGIARIO = 'estagiario';

    public function label(): string
    {
        return match($this) {
            self::ESTATUTARIO => 'Estatutário',
            self::COMISSIONADO => 'Comissionado',
            self::CONTRATADO => 'Contratado',
            self::TEMPORARIO => 'Temporário',
            self::ESTAGIARIO => 'Estagiário',
        };
    }
}
