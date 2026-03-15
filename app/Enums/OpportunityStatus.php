<?php

namespace App\Enums;

enum OpportunityStatus: string
{
    case Open = 'aberta';
    case InProgress = 'em_andamento';
    case Won = 'ganha';
    case Lost = 'perdida';

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Aberta',
            self::InProgress => 'Em andamento',
            self::Won => 'Ganha',
            self::Lost => 'Perdida',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'value');
    }
}
