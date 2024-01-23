<?php

namespace App\Filament\Resources\AreaResource\Pages;

use App\Filament\Resources\AreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;

class ListAreas extends ListRecords
{
    protected static string $resource = AreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
             ExcelImportAction::make()
                ->label('Importar productos')
                ->modalHeading('Importar Excel')
                ->modalDescription('Importar datos a la base de datos desde un archivo Excel.')
                ->color("success"),
            Actions\CreateAction::make()
                ->icon('heroicon-m-squares-plus'),
        ];
    }
}
