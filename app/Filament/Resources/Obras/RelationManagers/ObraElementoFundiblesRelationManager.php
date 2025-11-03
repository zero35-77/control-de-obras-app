<?php

namespace App\Filament\Resources\Obras\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ObraElementoFundiblesRelationManager extends RelationManager
{
    protected static string $relationship = 'obraElementoFundibles';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('elemento_fundible_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('fecha_hora_fundicion'),
                TextInput::make('obrero_id')
                    ->numeric(),
                TextInput::make('numero_boleta'),
                DatePicker::make('fecha_verificacion'),
                TextInput::make('cantidad_psi_utilizado')
                    ->numeric(),
                TextInput::make('resultado_ensayo_requerido')
                    ->numeric(),
                TextInput::make('resultado_ensayo_obtenido')
                    ->numeric(),
                TextInput::make('comentarios'),
                Select::make('status')
                    ->options(['Realizado' => 'Realizado', 'Cancelado' => 'Cancelado', 'Pendiente' => 'Pendiente'])
                    ->default('Pendiente')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('obraElementosFundibles')
            ->columns([
                TextColumn::make('elemento_fundible_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha_hora_fundicion')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('obrero_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('numero_boleta')
                    ->searchable(),
                TextColumn::make('fecha_verificacion')
                    ->date()
                    ->sortable(),
                TextColumn::make('cantidad_psi_utilizado')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('resultado_ensayo_requerido')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('resultado_ensayo_obtenido')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('comentarios')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
