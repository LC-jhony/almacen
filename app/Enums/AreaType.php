<?php declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AreaType: string implements HasLabel
{
    case ACTIVO = 'Activo';
    case INACTIVO = 'Inactivo';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVO => 'Activo',
            self::INACTIVO => 'Inactivo',
        };
    }
}

