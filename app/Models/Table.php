<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $guarded = ['id'];

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function orders()
    {
        return $this->hasMany(TableOrder::class);
    }
}
