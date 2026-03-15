<?php

namespace App\Enums;

enum ProposalStatus: string
{
    case Draft = 'rascunho';
    case Sent = 'enviada';
    case Accepted = 'aceita';
    case Refused = 'recusada';
    case Expired = 'expirada';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Rascunho',
            self::Sent => 'Enviada',
            self::Accepted => 'Aceita',
            self::Refused => 'Recusada',
            self::Expired => 'Expirada',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'value');
    }
}
