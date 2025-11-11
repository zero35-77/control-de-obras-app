<?php

namespace App\Filament\Resources\Obras\RelationManagers;

use App\Enums\ConcreteHardness;
use App\Models\Obrero;
use App\Models\ElementoFundible;
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
use Carbon\Carbon;
use Filament\Notifications\Notification;


class ObraElementoFundiblesRelationManager extends RelationManager
{
    protected static string $relationship = 'obraElementoFundibles';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('elemento_fundible_id')
                ->options(ElementoFundible::pluck('name', 'id')->toArray()),
                DateTimePicker::make('fecha_hora_fundicion')
                    ->native(false)
                    ->live()
                    ->displayFormat('d/m/Y H:i')
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $this->calculateAndSetResults($set, $get);
                    }),
                Select::make('obrero_id')
                ->options(Obrero::pluck('name', 'id')->toArray()),
                TextInput::make('numero_boleta'),
                DatePicker::make('fecha_verificacion')
                    ->native(false)
                    ->live()
                    ->displayFormat('d/m/Y')
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $this->calculateAndSetResults($set, $get);
                    }),
                TextInput::make('cantidad_psi_utilizado')
                    ->numeric()
                    ->live()
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $this->calculateAndSetResults($set, $get);
                    }),
                TextInput::make('resultado_ensayo_requerido')
                    ->label('Resultado Ensayo Requerido')
                    ->numeric()
                    ->readOnly(),
                TextInput::make('resultado_ensayo_obtenido')
                    ->numeric(),
                TextInput::make('comentarios'),
                Select::make('status')
                    ->options(['Realizado' => 'Realizado', 'Cancelado' => 'Cancelado', 'Pendiente' => 'Pendiente'])
                    ->default('Pendiente')
                    ->required(),
                TextInput::make('semana_inicio')
                    ->numeric(),
                TextInput::make('semana_fin')
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('obraElementosFundibles')
            ->columns([
                TextColumn::make('elementoFundible.name')
                    ->label('Elemento Fundible')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('fecha_hora_fundicion')
                    ->dateTime()
                    ->sortable(),
               TextColumn::make('obrero.name')
                    ->label('Obrero')
                    ->sortable()
                    ->searchable(),
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
                CreateAction::make()
                ->after(function ($record) {
                        $this->checkAndFlash($record);
                    }),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make()
                ->after(function ($record) {
                        $this->checkAndFlash($record);
                    }),
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

    /**
     * Calcular y setear resultado_ensayo_requerido.
     */
    private function calculateAndSetResults(callable $set, callable $get): void
    {
        $fechaFundState = $get('fecha_hora_fundicion');
        $fechaVerState  = $get('fecha_verificacion');
        $cantidadState  = $get('cantidad_psi_utilizado');

        if (! $fechaFundState || ! $fechaVerState) {
            $set('resultado_ensayo_requerido', null);
            return;
        }

        try {
            $fechaFund = Carbon::parse($fechaFundState);
            $fechaVer  = Carbon::parse($fechaVerState);
        } catch (\Exception $e) {
            $set('resultado_ensayo_requerido', null);
            return;
        }

        $dias = $fechaFund->startOfDay()->diffInDays($fechaVer->startOfDay());

        if (! is_numeric($cantidadState) || $cantidadState === '') {
            $set('resultado_ensayo_requerido', null);
            return;
        }

        $cantidad = (float) $cantidadState;

        $percentEnum = ConcreteHardness::selectByDays($dias);
        $multiplier = $percentEnum->percentage(); 

        $resultado = $cantidad * $multiplier;

        $set('resultado_ensayo_requerido', round($resultado, 2));
    }
        private function checkAndFlash($record): void
    {
        if (! isset($record->resultado_ensayo_requerido) || ! isset($record->resultado_ensayo_obtenido)) {
            return;
        }

        if (! is_numeric($record->resultado_ensayo_requerido) || ! is_numeric($record->resultado_ensayo_obtenido)) {
            return;
        }

        if ($record->resultado_ensayo_requerido > $record->resultado_ensayo_obtenido) {
            Notification::make()
                ->title('Resultado fuera de rango')
                ->danger()
                ->body('El resultado obtenido es menor que el requerido. Por favor verifique el motivo.')
                ->send();
        }
    }
}
