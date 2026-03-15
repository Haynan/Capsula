<?php

namespace App\Enums;

enum LeadStatus: string
{
    case New = 'novo';
    case Contacted = 'contatado';
    case Qualified = 'qualificado';
    case Proposal = 'proposta';
    case Converted = 'convertido';
    case Lost = 'perdido';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Novo',
            self::Contacted => 'Contatado',
            self::Qualified => 'Qualificado',
            self::Proposal => 'Em proposta',
            self::Converted => 'Convertido',
            self::Lost => 'Perdido',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'value');
    }
}
