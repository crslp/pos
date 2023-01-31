<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;

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

it('has a create form', function () {
   $this->get(route('items.create'))->assertSee(__('Save'));
});

it('can create an item', function () {
    livewire(\App\Http\Livewire\ItemCreate::class)
        ->set('name', 'Milk')
        ->set('price', 1.99)
        ->call('save');

    $this->get(route('items.create'))
        ->assertSee('Milk')
        ->assertSee('1.99');
});
