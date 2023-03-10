<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('can list items', function () {
    \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);

    $this->get(route('item.index'))
        ->assertSee('Glass of Milk')
        ->assertSee('1.99')
        ->assertSeeLivewire(\App\Http\Livewire\ItemIndex::class);
});

it('has a create form', function () {
    $this->get(route('item.create'))->assertSee(__('Save'));
});

it('can create an item', function () {
    livewire(\App\Http\Livewire\ItemCreate::class)
        ->set('name', 'Milk')
        ->set('price', 1.99)
        ->call('save');

    $this->get(route('item.create'))
        ->assertSee('Milk')
        ->assertSee('1.99');
});

it('can delete an item', function () {
    $milk = \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);
    \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 5.99,
    ]);

    livewire(\App\Http\Livewire\ItemIndex::class)
        ->call('destroy', $milk->id);

    $this->get(route('item.index'))
        ->assertDontSee('Glass of Milk')
        ->assertSee('Glass of Wine')
        ->assertSee('5.99');
});
