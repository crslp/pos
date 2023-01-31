<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Table;
use App\Models\TableOrder;
use Illuminate\Database\Seeder;

class TableOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = Table::all()->random();

        $items = Item::take(rand(1, 5))->get();

        foreach ($items as $item) {
            TableOrder::create([
                'table_id' => $table->id,
                'item_id' => $item->id,
            ]);
        }
    }
}
