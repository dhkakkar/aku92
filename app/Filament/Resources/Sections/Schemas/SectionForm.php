<?php

namespace App\Filament\Resources\Sections\Schemas;

use App\Models\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Schema;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('page')
                    ->options(Section::pageOptions())
                    ->required()
                    ->searchable(),
                TextInput::make('key')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Unique identifier used in code to pull this content.'),
                TextInput::make('title')->maxLength(255),
                TextInput::make('subtitle')->maxLength(255),
                RichEditor::make('content')->columnSpanFull(),
                KeyValue::make('meta')
                    ->keyLabel('Property')
                    ->valueLabel('Value')
                    ->columnSpanFull()
                    ->helperText('Optional structured data (e.g. icon, link, stat numbers).'),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
            ]);
    }
}
