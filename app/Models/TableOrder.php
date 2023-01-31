<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOrder extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}