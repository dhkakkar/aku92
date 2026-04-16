<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Order')
                ->schema([
                    TextInput::make('order_number')->disabled()->dehydrated(false),
                    Select::make('status')
                        ->options([
                            'pending'          => 'Pending',
                            'confirmed'        => 'Confirmed',
                            'shipped'          => 'Shipped',
                            'delivered'        => 'Delivered',
                            'cancelled'        => 'Cancelled',
                            'return_requested' => 'Return Requested',
                            'returned'         => 'Returned',
                        ])
                        ->required()
                        ->default('pending'),
                    Select::make('payment_method')
                        ->options(['cod' => 'Cash on Delivery', 'online' => 'Online'])
                        ->default('cod'),
                    TextInput::make('total')->label('Total (₹)')->numeric()->disabled()->dehydrated(false),
                ])->columns(2),

            Section::make('Customer')
                ->schema([
                    TextInput::make('customer_name')->required(),
                    TextInput::make('customer_email')->email()->required(),
                    TextInput::make('customer_phone')->tel()->required(),
                ])->columns(2),

            Section::make('Shipping')
                ->schema([
                    Textarea::make('shipping_address')->rows(2)->required()->columnSpanFull(),
                    TextInput::make('city')->required(),
                    TextInput::make('state')->required(),
                    TextInput::make('pincode')->required(),
                ])->columns(3),

            Section::make('Amounts')
                ->schema([
                    TextInput::make('subtotal')->label('Subtotal (₹)')->numeric()->disabled()->dehydrated(false),
                    TextInput::make('shipping')->label('Shipping (₹)')->numeric()->disabled()->dehydrated(false),
                ])->columns(2),

            Section::make('Notes & reasons')
                ->schema([
                    Textarea::make('notes')->label('Customer notes')->rows(3)->columnSpanFull(),
                    Textarea::make('cancel_reason')->label('Cancellation reason')->rows(2)->columnSpanFull(),
                    Textarea::make('return_reason')->label('Return reason')->rows(2)->columnSpanFull(),
                ]),
        ]);
    }
}
