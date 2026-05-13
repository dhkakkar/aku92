<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->maxLength(150),
            TextInput::make('email')->email()->required()->maxLength(150),
            TextInput::make('phone')->tel()->maxLength(20),
            TextInput::make('subject')->required()->maxLength(200)->columnSpanFull(),
            Textarea::make('message')->required()->rows(6)->columnSpanFull(),
            Toggle::make('is_read')->label('Mark as read')->default(false),
        ])->columns(2);
    }
}
