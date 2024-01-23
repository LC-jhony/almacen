<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum loanType: string implements HasLabel
{
    case INTERNO = 'Interno';
    case EXTERNO = 'Externo';
    public function getLabel(): ?string
    {
        return match ($this) {
            self::INTERNO => 'Interno',
            self::EXTERNO => 'Externo',
        };
    }
}
