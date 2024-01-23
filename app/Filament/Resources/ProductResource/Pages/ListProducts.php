<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

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
