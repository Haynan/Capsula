<?php

namespace App\Enums;

enum ClientServiceStatus: string
{
    case Active = 'ativo';
    case Inactive = 'inativo';
    case PendingRenewal = 'pendente_renovacao';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Ativo',
            self::Inactive => 'Inativo',
            self::PendingRenewal => 'Pendente de renovacao',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'value');
    }
}
