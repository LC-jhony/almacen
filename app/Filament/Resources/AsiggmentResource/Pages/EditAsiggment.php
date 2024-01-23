<?php

namespace App\Filament\Resources\AsiggmentResource\Pages;

use App\Filament\Resources\AsiggmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsiggment extends EditRecord
{
    protected static string $resource = AsiggmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
