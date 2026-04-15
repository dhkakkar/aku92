<?php

namespace App\Filament\Resources\Sections\Tables;

use App\Models\Section;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page')
                    ->formatStateUsing(fn ($state) => Section::pageOptions()[$state] ?? $state)
                    ->badge()
                    ->sortable(),
                TextColumn::make('key')->searchable()->toggleable(),
                TextColumn::make('title')->searchable()->limit(40),
                TextColumn::make('sort_order')->sortable()->label('Order'),
                IconColumn::make('is_active')->boolean()->label('Active'),
                TextColumn::make('updated_at')->dateTime('M j, Y H:i')->toggleable(),
            ])
            ->defaultGroup('page')
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('page')->options(Section::pageOptions()),
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
