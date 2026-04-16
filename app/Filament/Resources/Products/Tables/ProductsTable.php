<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')->searchable()->sortable()->limit(40),
                TextColumn::make('category')->badge()->sortable()->toggleable(),
                TextColumn::make('sale_price')->label('Sale (₹)')->money('INR')->sortable(),
                TextColumn::make('original_price')->label('Original (₹)')->money('INR')->sortable()->toggleable(),
                TextColumn::make('stock')->sortable(),
                IconColumn::make('is_active')->boolean()->label('Active'),
                TextColumn::make('updated_at')->dateTime('M j, Y H:i')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('category')
                    ->options(fn () => \App\Models\Product::query()
                        ->whereNotNull('category')
                        ->distinct()
                        ->pluck('category', 'category')
                        ->toArray()),
                TernaryFilter::make('is_active')->label('Active')->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
