<?php

namespace App\Filament\Resources\ElementoFundibles\Pages;

use App\Filament\Resources\ElementoFundibles\ElementoFundibleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListElementoFundibles extends ListRecords
{
    protected static string $resource = ElementoFundibleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
