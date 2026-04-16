<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->label('Order #')->searchable()->sortable(),
                TextColumn::make('customer_name')->searchable()->limit(30),
                TextColumn::make('customer_phone')->label('Phone')->toggleable(),
                TextColumn::make('total')->label('Total')->money('INR')->sortable(),
                TextColumn::make('payment_method')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn ($state) => strtoupper($state)),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'confirmed' => 'info',
                        'shipped'   => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default     => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')->label('Placed')->dateTime('d M Y, H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'pending'   => 'Pending',
                    'confirmed' => 'Confirmed',
                    'shipped'   => 'Shipped',
                    'delivered' => 'Delivered',
                    'cancelled' => 'Cancelled',
                ]),
                SelectFilter::make('payment_method')->options(['cod' => 'COD', 'online' => 'Online']),
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
