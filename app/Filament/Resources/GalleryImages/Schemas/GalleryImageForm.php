<?php

namespace App\Filament\Resources\GalleryImages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->maxLength(255)
                ->helperText('Optional — shown as a caption on hover.'),

            TextInput::make('category')
                ->required()
                ->maxLength(100)
                ->datalist(fn () => \App\Models\GalleryImage::query()
                    ->whereNotNull('category')
                    ->distinct()
                    ->pluck('category')
                    ->filter()
                    ->values()
                    ->all())
                ->helperText('Used as a tab on the public gallery (e.g. Akash Jain, Prashuka Jain, Clinics, Events).'),

            FileUpload::make('image')
                ->image()
                ->disk('public')
                ->directory('gallery')
                ->visibility('public')
                ->required()
                ->columnSpanFull()
                ->imageEditor()
                ->maxSize(8192),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0)
                ->helperText('Lower numbers appear first within their category.'),

            Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        ])->columns(2);
    }
}
