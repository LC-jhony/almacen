<?php

namespace App\Livewire\Kardex;

use App\Enum\MonthType;
use App\Models\Category;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class MonthlyValuation extends Component implements HasForms
{
    use InteractsWithForms;
    public $categoriesWithProducts;

    public $month;

    public $monthName;

    public function mount(): void
    {
        $this->month = $this->month ?? now()->format('m');
        $this->monthName = Carbon::createFromFormat('m', $this->month)
            ->locale('es')
            ->translatedFormat('F');
        $this->categoriesWithProducts = Category::where('status', true)
            ->with(['materials.balance' => function ($query) {
                $query->whereMonth('created_at', $this->month);
            }])
            ->get();
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('month')
                    ->label('Mes')
                    ->options(MonthType::class)
                    ->searchable()
                    ->reactive()
                    ->native(false),
            ]);
    }
    public function render()
    {
        return view('livewire.kardex.monthly-valuation');
    }
}
