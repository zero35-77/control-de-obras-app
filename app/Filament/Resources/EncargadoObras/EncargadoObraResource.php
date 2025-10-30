<?php

namespace App\Filament\Resources\EncargadoObras;

use App\Filament\Resources\EncargadoObras\Pages\CreateEncargadoObra;
use App\Filament\Resources\EncargadoObras\Pages\EditEncargadoObra;
use App\Filament\Resources\EncargadoObras\Pages\ListEncargadoObras;
use App\Filament\Resources\EncargadoObras\Schemas\EncargadoObraForm;
use App\Filament\Resources\EncargadoObras\Tables\EncargadoObrasTable;
use App\Models\EncargadoObra;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EncargadoObraResource extends Resource
{
    protected static ?string $model = EncargadoObra::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'EncargadoObra';

    public static function form(Schema $schema): Schema
    {
        return EncargadoObraForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EncargadoObrasTable::configure($table);
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
            'index' => ListEncargadoObras::route('/'),
            'create' => CreateEncargadoObra::route('/create'),
            'edit' => EditEncargadoObra::route('/{record}/edit'),
        ];
    }
}
