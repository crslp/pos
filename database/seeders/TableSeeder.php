<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            __('One'),
            __('Two'),
            __('Three'),
            __('Four'),
            __('Take Away'),
        ];

        foreach ($tables as $table) {
            Table::create(['name' => $table]);
        }
    }
}
