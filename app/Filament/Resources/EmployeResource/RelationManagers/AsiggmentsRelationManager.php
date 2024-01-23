<?php

namespace App\Filament\Resources\EmployeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asiggment;
use Filament\Tables\Actions\ActionGroup;

class AsiggmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'asiggments';
   protected static ?string $modelLabel = 'Cargo';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Herramientas')
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
                Tables\Columns\TextColumn::make('code'),
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                     ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->color('success'),
                    Tables\Actions\DeleteAction::make()
                        ->color('danger')
                ])->color('info'),
                //Tables\Actions\EditAction::make(),
               // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

}
