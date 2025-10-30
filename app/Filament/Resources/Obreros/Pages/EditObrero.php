<?php

namespace App\Filament\Resources\Obreros\Pages;

use App\Filament\Resources\Obreros\ObreroResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditObrero extends EditRecord
{
    protected static string $resource = ObreroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
