<?php

namespace App\Enums;

enum LeadPriority: string
{
    case Low = 'baixa';
    case Normal = 'normal';
    case High = 'alta';

    public function label(): string
    {
        return match ($this) {
            self::Low => 'Baixa',
            self::Normal => 'Normal',
            self::High => 'Alta',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'value');
    }
}
