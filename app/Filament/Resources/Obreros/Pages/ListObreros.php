<?php

namespace App\Filament\Resources\Obreros\Pages;

use App\Filament\Resources\Obreros\ObreroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListObreros extends ListRecords
{
    protected static string $resource = ObreroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
