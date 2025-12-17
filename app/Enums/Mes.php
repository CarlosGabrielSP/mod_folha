<?php

namespace App\Enums;

enum Mes: int
{
    case JAN = 1;
    case FEV = 2;
    case MAR = 3;
    case ABR = 4;
    case MAI = 5;
    case JUN = 6;
    case JUL = 7;
    case AGO = 8;
    case SET = 9;
    case OUT = 10;
    case NOV = 11;
    case DEZ = 12;

    public function label(): string
    {
        return match ($this) {
            self::JAN => 'Janeiro',
            self::FEV => 'Fevereiro',
            self::MAR => 'Marco',
            self::ABR => 'Abril',
            self::MAI => 'Maio',
            self::JUN => 'Junho',
            self::JUL => 'Julho',
            self::AGO => 'Agosto',
            self::SET => 'Setembro',
            self::OUT => 'Outubro',
            self::NOV => 'Novembro',
            self::DEZ => 'Dezembro',
        };
    }

    public function toArray(): array
    {
        $array = [];

        foreach (self::cases() as $case) {
            $array[$case->value] = [
                'name' => $case->name,
                'label' => $case->label(),
            ];
        }

        return $array;
    }
}
