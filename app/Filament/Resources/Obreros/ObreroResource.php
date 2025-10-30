<?php

namespace App\Filament\Resources\Obreros;

use App\Filament\Resources\Obreros\Pages\CreateObrero;
use App\Filament\Resources\Obreros\Pages\EditObrero;
use App\Filament\Resources\Obreros\Pages\ListObreros;
use App\Filament\Resources\Obreros\Schemas\ObreroForm;
use App\Filament\Resources\Obreros\Tables\ObrerosTable;
use App\Models\Obrero;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ObreroResource extends Resource
{
    protected static ?string $model = Obrero::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Obrero';

    public static function form(Schema $schema): Schema
    {
        return ObreroForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ObrerosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListObreros::route('/'),
            'create' => CreateObrero::route('/create'),
            'edit' => EditObrero::route('/{record}/edit'),
        ];
    }
}
