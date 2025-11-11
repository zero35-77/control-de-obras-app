<?php

namespace App\Filament\Resources\Obras\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class ObraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo')
                    ->required(),
                TextInput::make('localizacion')
                    ->required(),
                Select::make('encargado_obra_id')
                                            ->label('Encargado de Obra')
                                            ->relationship('encargadoObra', 'name')
                                            ->required(),
                                            TextInput::make('cantidad_semanas')
                    ->numeric()
                    ->required(),
            ]);
    }
}
