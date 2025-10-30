<?php

namespace App\Filament\Resources\EncargadoObras\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EncargadoObraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
