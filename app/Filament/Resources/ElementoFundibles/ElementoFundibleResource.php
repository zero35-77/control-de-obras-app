<?php

namespace App\Filament\Resources\ElementoFundibles;

use App\Filament\Resources\ElementoFundibles\Pages\CreateElementoFundible;
use App\Filament\Resources\ElementoFundibles\Pages\EditElementoFundible;
use App\Filament\Resources\ElementoFundibles\Pages\ListElementoFundibles;
use App\Filament\Resources\ElementoFundibles\Schemas\ElementoFundibleForm;
use App\Filament\Resources\ElementoFundibles\Tables\ElementoFundiblesTable;
use App\Models\ElementoFundible;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ElementoFundibleResource extends Resource
{
    protected static ?string $model = ElementoFundible::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ElementoFundible';

    public static function form(Schema $schema): Schema
    {
        return ElementoFundibleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ElementoFundiblesTable::configure($table);
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
            'index' => ListElementoFundibles::route('/'),
            'create' => CreateElementoFundible::route('/create'),
            'edit' => EditElementoFundible::route('/{record}/edit'),
        ];
    }
}
