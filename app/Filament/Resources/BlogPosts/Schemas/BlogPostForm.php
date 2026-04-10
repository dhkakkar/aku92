<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Models\BlogPost;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('owner')
                    ->label('Belongs To')
                    ->options(BlogPost::ownerOptions())
                    ->searchable()
                    ->required()
                    ->helperText('Select the doctor or firm this article belongs to.'),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true),

                TextInput::make('slug')
                    ->maxLength(255)
                    ->helperText('Leave blank to auto-generate from title.')
                    ->unique(ignoreRecord: true),

                TextInput::make('category')
                    ->maxLength(100)
                    ->placeholder('e.g. Cardiology, Healthcare, Research'),

                TextInput::make('author')
                    ->maxLength(150)
                    ->placeholder('Defaults to owner name if blank'),

                FileUpload::make('featured_image')
                    ->image()
                    ->directory('blog-images')
                    ->disk('public')
                    ->imagePreviewHeight('150')
                    ->maxSize(5120),

                Textarea::make('excerpt')
                    ->rows(3)
                    ->maxLength(500)
                    ->helperText('Short summary shown in card listings.'),

                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->default(true)
                    ->inline(false),

                DateTimePicker::make('published_at')
                    ->helperText('Leave blank to auto-set when publishing.'),
            ]);
    }
}
