<?php

namespace App\Filament\Resources\ElementoFundibles\Pages;

use App\Filament\Resources\ElementoFundibles\ElementoFundibleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditElementoFundible extends EditRecord
{
    protected static string $resource = ElementoFundibleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
