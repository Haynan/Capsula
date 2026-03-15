<?php

namespace App\Enums;

enum ClientType: string
{
    case Individual = 'PF';
    case Company = 'PJ';

    public function label(): string
    {
        return match ($this) {
            self::Individual => 'Pessoa fisica',
            self::Company => 'Pessoa juridica',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'value');
    }
}
