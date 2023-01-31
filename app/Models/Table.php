<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $guarded = ['id'];

    public function getTotalAttribute(): float
    {
        return $this->orders->map(fn ($tableOrder) => $tableOrder->item->price)->sum();
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function orders()
    {
        return $this->hasMany(TableOrder::class);
    }
}
