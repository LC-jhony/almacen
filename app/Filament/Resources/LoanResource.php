<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Area;
use App\Models\Loan;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use App\Enums\loanType;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\LoanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LoanResource\RelationManagers;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use App\Filament\Resources\LoanResource\RelationManagers\ProductsRelationManager;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $modelLabel = 'Prestamo';
    protected static ?string $navigationGroup = 'reporte';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Section::make('Registrar Prestamo')
                            ->description('Formulario para registra los prestamos de obra')
                            ->schema([
                                Forms\Components\Select::make('area_id')
                                    ->label('Area')
                                    ->options(Area::query()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                                Forms\Components\Select::make('type')
                                    ->label('Tipo prestamo')
                                    ->options(loanType::class)
                                    ->required(),
                            ])->columns(2)
                    ]),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('Productos prestados'),
                        Forms\Components\Repeater::make('productLoan')
                            ->relationship()
                            ->schema([
                                Forms\Components\select::make('product_id')
                                    ->label('Nombre')
                                    ->options(Product::query()->pluck('name', 'id'))
                                    ->reactive()
                                    ->required()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $product = Product::find($state);
                                        if ($product) {
                                            $set('code', $product->code);
                                        }
                                    })
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('code')
                                    ->label('Codigo'),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('cantidad')
                                    ->numeric()
                            ])
                            ->columns(4)
                            ->reorderableWithButtons()
                    ])
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(5)
            ->reorderable('sort')
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('area.name')
                    ->searchable()
                    ->sortable(),
                ToggleIconColumn::make('status')
                    ->label('Estado')
                    ->alignCenter()
                    ->translateLabel()
                    ->onIcon('heroicon-s-check-badge')
                    ->offIcon('heroicon-o-x-circle')
                    ->offColor('danger')
                    ->tooltip(fn (Model $record) => $record->status ? 'Cargo' : 'Internado'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo prestamo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Interno' => 'success',
                        'Externo' => 'danger',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('area_id')
                    ->label('Area | obra')
                    ->searchable()
                    ->options(Area::all()->pluck('name', 'id')),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\Action::make('Pdf')
                    ->label('Exportar PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('warning')                 
                    ->url(fn(Loan $record)=> route('download.pdf', $record))
                    ->openUrlInNewTab(),
                    Tables\Actions\EditAction::make()
                        ->color('success'),
                    Tables\Actions\DeleteAction::make()
                        ->color('danger')
                ])->color('info'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

protected function getTemplateSection(): Component
{
    return Section::make('report')
        ->description('reporte de prestamos materiales de almacen')
        ->schema([
            Grid::make('1')
                ->schema([
                    FileUpload::make('logo')
                        ->openable()
                        ->maxSize(1024)
                        ->localizeLabel()
                        ->uploadButtonPosition('center bottom')
                        ->uploadProgressIndicatorPosition('center bottom')
                        ->getUploadedFileNameForStorageUsing(
                                static fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(Auth::user()->currentCompany->id . '_'),
                            )
                            ->extraAttributes([
                                'class' => 'aspect-[3/2] w-[9.375rem] max-w-full',
                            ])
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/gif']),
                ])
        ]);

}

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }
}
