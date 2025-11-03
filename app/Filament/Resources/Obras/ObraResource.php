<?php

namespace App\Filament\Resources\Obras;

use App\Filament\Resources\Obras\Pages\CreateObra;
use App\Filament\Resources\Obras\Pages\EditObra;
use App\Filament\Resources\Obras\Pages\ListObras;
use App\Filament\Resources\Obras\RelationManagers\ObraElementoFundiblesRelationManager;
use App\Filament\Resources\Obras\Schemas\ObraForm;
use App\Filament\Resources\Obras\Tables\ObrasTable;
use App\Models\Obra;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ObraResource extends Resource
{
    protected static ?string $model = Obra::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Obra';

    public static function form(Schema $schema): Schema
    {
        return ObraForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ObrasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ObraElementoFundiblesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListObras::route('/'),
            'create' => CreateObra::route('/create'),
            'edit' => EditObra::route('/{record}/edit'),
        ];
    }
}
