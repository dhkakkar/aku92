<?php

namespace App\Filament\Resources\GalleryImages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class GalleryImagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->disk('public')->square()->size(60)->label('Image'),
                TextColumn::make('title')->searchable()->limit(40),
                TextColumn::make('category')->badge()->sortable(),
                TextColumn::make('sort_order')->label('Order')->sortable()->toggleable(),
                IconColumn::make('is_active')->boolean()->label('Active'),
                TextColumn::make('updated_at')->dateTime('d M Y H:i')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultGroup('category')
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('category')->options(fn () => \App\Models\GalleryImage::query()
                    ->whereNotNull('category')
                    ->distinct()
                    ->pluck('category', 'category')
                    ->filter()
                    ->all()),
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
