<?php

namespace App\Filament\Resources\EncargadoObras\Pages;

use App\Filament\Resources\EncargadoObras\EncargadoObraResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEncargadoObras extends ListRecords
{
    protected static string $resource = EncargadoObraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
