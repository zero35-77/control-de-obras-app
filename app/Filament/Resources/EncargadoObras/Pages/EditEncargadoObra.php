<?php

namespace App\Filament\Resources\EncargadoObras\Pages;

use App\Filament\Resources\EncargadoObras\EncargadoObraResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEncargadoObra extends EditRecord
{
    protected static string $resource = EncargadoObraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
