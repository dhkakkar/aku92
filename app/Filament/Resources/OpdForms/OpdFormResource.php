<?php

namespace App\Filament\Resources\OpdForms;

use App\Filament\Resources\OpdForms\Pages\CreateOpdForm;
use App\Filament\Resources\OpdForms\Pages\EditOpdForm;
use App\Filament\Resources\OpdForms\Pages\ListOpdForms;
use App\Filament\Resources\OpdForms\Schemas\OpdFormForm;
use App\Filament\Resources\OpdForms\Tables\OpdFormsTable;
use App\Models\OpdForm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OpdFormResource extends Resource
{
    protected static ?string $model = OpdForm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return OpdFormForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OpdFormsTable::configure($table);
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
            'index' => ListOpdForms::route('/'),
            'create' => CreateOpdForm::route('/create'),
            'edit' => EditOpdForm::route('/{record}/edit'),
        ];
    }
}
