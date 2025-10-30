<?php

namespace App\Filament\Resources\ElementoFundibles\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ElementoFundibleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
            ]);
    }
}
