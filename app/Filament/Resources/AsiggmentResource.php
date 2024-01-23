<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsiggmentResource\Pages;
use App\Filament\Resources\AsiggmentResource\RelationManagers;
use App\Models\Asiggment;
use App\Models\Employe;
use App\Models\Tool;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;


class AsiggmentResource extends Resource
{
    protected static ?string $model = Asiggment::class;
    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';
    protected static ?string $navigationGroup = 'Almacen';
    protected static ?string $modelLabel = 'Cargo';

    public static function form(Form $form): Form
    {
        $tools = Tool::get();
        return $form
            ->schema([
                Section::make('Registrar Cargo de heramienta')
                    ->description('Formulario para registra las herramientas asignadas alos trabajadores')

                    ->schema([
                        Forms\Components\Select::make('tool_id')
                            ->label('Herramienta')
                            ->relationship('tool', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('employe_id')
                            ->label('Trabajador')
                            ->relationship(name: 'employe', titleAttribute: 'full_name')
                            ->searchable(['full_name', 'dni'])
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('description')
                            ->label('Descripcion')
                            ->required()
                            ->nullable()
                            ->maxLength(65535),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad')

                            ->required(),
                        Forms\Components\TextInput::make('code')
                            ->label('Codigo')
                            ->required()
                            ->numeric(),
                    ])->columns(3)
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(5)
            ->reorderable('sort')
            ->striped()

            ->columns([
                Tables\Columns\TextColumn::make('tool.name')
                    ->label('Herramienta')
                    ->sortable(),
                Tables\Columns\TextColumn::make('employe_id')
                    ->label('Obrero')
                    ->formatStateUsing(function ($state, Asiggment $order) {
                        return $order->employe->full_name . ' ' . $order->employe->first_name . ' ' . $order->employe->last_name;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('descripcion')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('code')
                ->label('codigo')
                ->badge()
                ->color('success')
                    ->sortable(),
                // Tables\Columns\IconColumn::make('status')
                //     ->boolean(),
                ToggleIconColumn::make('status')
                    ->label('Estado')
                    ->alignCenter()
                    ->translateLabel()
                    ->onIcon('heroicon-s-tag')
                    ->offIcon('heroicon-o-tag')
                    ->onColor('primary')
                    ->offColor('danger')
                    ->tooltip(fn (Model $record) => $record->status ?'Internado':'Cargo' ),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->color('success'),
                    Tables\Actions\DeleteAction::make()
                        ->color('danger')
                ])->color('info'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    // BulkAction::make('export')
                    //     ->label('Export Xls')
                    //     ->icon('heroicon-o-document-arrow-down')
                    //     ->color('success')
                    //     ->action(fn (Collection $records)
                    //     => (new AssigmentsExport($records))
                    //         ->download('prestamos.xlsx')),
                ]),
            ]);
    }
    public static function getRelations(): array
    {
        return [
                //EmployeRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsiggments::route('/'),
            //'create' => Pages\CreateAsiggment::route('/create'),
            'create' => Pages\Cargo::route('/create'),
            'edit' => Pages\EditAsiggment::route('/{record}/edit'),
        ];
    }
}
