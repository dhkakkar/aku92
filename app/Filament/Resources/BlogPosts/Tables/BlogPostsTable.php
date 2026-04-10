<?php

namespace App\Filament\Resources\BlogPosts\Tables;

use App\Models\BlogPost;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BlogPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->disk('public')
                    ->square()
                    ->size(50),

                TextColumn::make('title')
                    ->searchable()
                    ->limit(50)
                    ->sortable(),

                TextColumn::make('owner')
                    ->label('Belongs To')
                    ->formatStateUsing(fn (string $state): string => BlogPost::ownerOptions()[$state] ?? $state)
                    ->badge()
                    ->sortable(),

                TextColumn::make('category')
                    ->badge()
                    ->color('gray'),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('owner')
                    ->label('Belongs To')
                    ->options(BlogPost::ownerOptions()),
                TernaryFilter::make('is_published')
                    ->label('Published'),
            ])
            ->defaultSort('published_at', 'desc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
