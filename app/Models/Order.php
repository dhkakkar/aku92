<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'customer_name', 'customer_email', 'customer_phone',
        'shipping_address', 'city', 'state', 'pincode',
        'payment_method', 'subtotal', 'shipping', 'total', 'status', 'notes',
        'cancel_reason', 'return_reason',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function isCancellable(): bool
    {
        return in_array($this->status, ['pending', 'confirmed'], true);
    }

    public function isReturnable(): bool
    {
        return $this->status === 'delivered';
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->order_number)) {
                $order->order_number = 'AKU-' . strtoupper(uniqid());
            }
        });
    }
}
