<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list items', function () {
    \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);

    $this->get(route('items.index'))
        ->assertSee('Glass of Milk')
        ->assertSee('1.99')
        ->assertSeeLivewire(\App\Http\Livewire\ItemIndex::class);
});

