<?php

namespace App\Filament\Resources\AsiggmentResource\Pages;

use App\Filament\Resources\AsiggmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsiggments extends ListRecords
{
    protected static string $resource = AsiggmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
               ->icon('heroicon-m-squares-plus'),
        ];
    }
}
