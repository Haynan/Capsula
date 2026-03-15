<?php

namespace App\Enums;

enum RenewalStatus: string
{
    case Pending = 'pendente';
    case Contacting = 'em_contato';
    case Renewed = 'renovada';
    case Lost = 'perdida';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendente',
            self::Contacting => 'Em contato',
            self::Renewed => 'Renovada',
            self::Lost => 'Perdida',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'value');
    }
}
