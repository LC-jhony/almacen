<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MonthlyValuation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static string $view = 'filament.pages.monthly-valuation';
    protected static ?string $title = 'Valorizacion Mensual';
    protected static ?string $navigationGroup = 'Reporte';
}
