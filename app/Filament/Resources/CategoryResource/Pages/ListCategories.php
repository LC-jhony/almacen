<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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
