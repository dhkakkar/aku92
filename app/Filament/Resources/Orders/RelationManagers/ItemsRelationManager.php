<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Order Items';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('product_name')->required(),
            TextInput::make('quantity')->numeric()->required(),
            TextInput::make('price')->label('Unit Price (₹)')->numeric()->required(),
            TextInput::make('total')->label('Line Total (₹)')->numeric()->required(),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_name')
            ->columns([
                TextColumn::make('product_name')->searchable()->limit(40),
                TextColumn::make('quantity')->label('Qty'),
                TextColumn::make('price')->label('Unit')->money('INR'),
                TextColumn::make('total')->money('INR'),
            ]);
    }
}
