<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ToolType: string implements HasLabel
{
    case NUEVO = 'Nuevo';
    case USADO = 'Usado';
    public function getLabel(): ?string
    {
        return match ($this) {
            self::NUEVO => 'Nuevo',
            self::USADO => 'Usado',
        };
    }
}
