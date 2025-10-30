<?php

namespace App\Filament\Resources\Obreros\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ObreroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
            ]);
    }
}
