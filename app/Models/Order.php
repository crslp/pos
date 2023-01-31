<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getTotalAttribute(): float
    {
        return $this->items->map(fn ($orderItem) => $orderItem->item->price)->sum();
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    public function markAsPaid(): bool
    {
        return $this->touch('paid_at');
    }
}
