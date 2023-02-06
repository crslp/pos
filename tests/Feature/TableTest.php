<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);
use function Pest\Livewire\livewire;

it('has table page', function () {
    $response = $this->get('/table');

    $response->assertStatus(200);
});

it('lists all tables', function () {
    app(\Database\Seeders\TableSeeder::class)->run();
    $response = $this->get('/table');
    $tables = \App\Models\Table::all()->map(fn ($t) => $t->name)->toArray();
    $response->assertSee($tables);
});

it('has table show page', function () {
    $table = \App\Models\Table::create(['name' => 'One']);

    $response = $this->get(route('table.show', $table->id));

    $response->assertStatus(200);
});

it('table show page lists all orders', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $order = \App\Models\Order::create(['table_id' => $table->id]);
    $milk = \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);
    $wine = \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 5.99,
    ]);
    \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $milk->id,
    ]);
    \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
    ]);

    $response = $this->get(route('table.show', $table->id));

    $response->assertSee(['Milk', 'Wine']);
    $response->assertStatus(200);
});

it('table show page allows to add items to order', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $milk = \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);
    $wine = \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 5.99,
    ]);

    $response = $this->get(route('table.show', $table->id));
    $response->assertSee(__('Add to order'));

    livewire(\App\Http\Livewire\TableShow::class, ['table' => $table])
        ->call('addToOrder', $milk->id)
        ->assertSee(__('Added'));
});

it('allows to remove items from order', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $order = \App\Models\Order::create(['table_id' => $table->id]);
    $milk = \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);
    $wine = \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 5.99,
    ]);
    $orderItem = \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $milk->id,
    ]);
    \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
    ]);

    $response = $this->get(route('table.show', $table->id));
    $response->assertSee(__('Remove'));

    livewire(\App\Http\Livewire\TableShow::class, ['table' => $table])
        ->call('removeFromOrder', $orderItem->id)
        ->assertSee(__('Removed'));
});

it('shows total order amount', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $order = \App\Models\Order::create(['table_id' => $table->id]);
    $milk = \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 4.99,
    ]);
    $wine = \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 9.99,
    ]);
    \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $milk->id,
    ]);
    \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
    ]);

    $response = $this->get(route('table.show', $table->id));
    $response->assertSee(14.98);
});

it('will delete the order if no order-items are left', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $order = \App\Models\Order::create(['table_id' => $table->id]);
    $wine = \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 9.99,
    ]);
    $orderItem = \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
    ]);

    livewire(\App\Http\Livewire\TableShow::class, ['table' => $table])
            ->call('removeFromOrder', $orderItem->id);

    $orders = \App\Models\Order::all();
    $this->assertTrue($orders->isEmpty());
});
