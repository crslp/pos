<?php

namespace Database\Seeders;

use App\Models\ReceiptItem;
use Illuminate\Database\Seeder;

class ReceiptItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReceiptItem::factory(3)->create();
    }
}
