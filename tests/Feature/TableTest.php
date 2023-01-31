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
