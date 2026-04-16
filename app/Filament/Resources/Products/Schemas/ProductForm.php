<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('category')
                    ->datalist([
                        'Books',
                        'Publications',
                        'Medical Supplies',
                        'Medicines',
                        'Equipment',
                    ])
                    ->helperText('Use a short label matching one of the shop filter categories.'),

                TextInput::make('image')
                    ->label('Image path')
                    ->helperText('Path under /public/images/, e.g. products/example.jpg.')
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('original_price')
                    ->label('Original price (₹)')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                TextInput::make('sale_price')
                    ->label('Sale price (₹)')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                TextInput::make('stock')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ])
            ->columns(2);
    }
}
