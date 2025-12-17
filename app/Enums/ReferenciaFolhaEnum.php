<?php

namespace App\Enums;

enum ReferenciaFolhaEnum: string
{
    case MENSAL = 'mensal';
    case FERIAS = 'ferias';
    case DECIMO_TERCEIRO = 'decimo_terceiro';
    case RESCISAO = 'rescisao';
    
    public function label(): string
    {
        return match($this) {
            self::MENSAL => 'Mensal',
            self::FERIAS => 'Férias',
            self::DECIMO_TERCEIRO => '13º Salário',
            self::RESCISAO => 'Rescisão',
        };
    }
}
