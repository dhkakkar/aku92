<?php

namespace App\Filament\Resources\OpdForms\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OpdFormForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('patient_name')->label('Patient Name')->required()->maxLength(150),
            TextInput::make('phone')->tel()->required()->maxLength(20),
            TextInput::make('age')->numeric()->required()->minValue(0)->maxValue(150),
            Select::make('gender')->options(['Male' => 'Male', 'Female' => 'Female'])->required(),
            Textarea::make('address')->rows(2)->required()->columnSpanFull(),
            Textarea::make('description')->label('Reason / Symptoms')->rows(4)->required()->columnSpanFull(),
            Select::make('status')
                ->options([
                    'pending'   => 'Pending',
                    'contacted' => 'Contacted',
                    'scheduled' => 'Scheduled',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('pending')
                ->required(),
        ])->columns(2);
    }
}
