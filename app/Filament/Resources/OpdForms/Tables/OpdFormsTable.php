<?php

namespace App\Filament\Resources\OpdForms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OpdFormsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient_name')->label('Patient')->searchable()->sortable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('age')->sortable()->toggleable(),
                TextColumn::make('gender')->badge()->toggleable(),
                TextColumn::make('address')->limit(40)->toggleable(),
                TextColumn::make('description')->label('Reason')->limit(50)->wrap()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'contacted' => 'info',
                        'scheduled' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default     => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')->label('Submitted')->dateTime('d M Y, H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'pending'   => 'Pending',
                    'contacted' => 'Contacted',
                    'scheduled' => 'Scheduled',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),
                SelectFilter::make('gender')->options(['Male' => 'Male', 'Female' => 'Female']),
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
