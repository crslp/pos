<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('has table page', function () {
    $response = $this->get('/table');

    $response->assertStatus(200);
});

it('lists all tables', function () {
    app(\Database\Seeders\TableSeeder::class)->run();
    $response = $this->get('/table');
    $tables = \App\Models\Table::all()->map(fn($t) => $t->name)->toArray();
    $response->assertSee($tables);
});

it('has table show page', function () {
    $table = \App\Models\Table::create(['name' => 'One']);

    $response = $this->get(route('table.show', $table->id));

    $response->assertStatus(200);
});

it('table show page lists all orders', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $milk = \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);
    $wine = \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 5.99,
    ]);
    \App\Models\TableOrder::create([
        'table_id' => $table->id,
        'item_id' => $milk->id,
    ]);
    \App\Models\TableOrder::create([
        'table_id' => $table->id,
        'item_id' => $wine->id,
    ]);

    $response = $this->get(route('table.show', $table->id));

    $response->assertSee(['Milk', 'Wine']);
    $response->assertStatus(200);
});
