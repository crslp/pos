<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);
use function Pest\Livewire\livewire;

it('offers to pay all items of order', function () {
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
    $order = \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $milk->id,
    ]);
    \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
    ]);
    $response = $this->get(route('table.show', $table->id));
    $response->assertSee(__('Pay all'));
});

it('does not offer pay-all button if no order-items are present', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $milk = \App\Models\Item::factory()->create([
        'name' => 'Glass of Milk',
        'price' => 1.99,
    ]);
    $wine = \App\Models\Item::factory()->create([
        'name' => 'Glass of Wine',
        'price' => 5.99,
    ]);

    livewire(\App\Http\Livewire\TableShow::class, ['table' => $table])
        ->assertDontSee(__('Pay all'));
});

it('has a checkout page', function () {
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

    $this->get(route('checkout.show', $order->id))
        ->assertSee($table->name)
        ->assertSee(__('Order').": {$order->id}")
        ->assertSee(7.98)
        ->assertSee(__('Confirm Payment'))
        ->assertSee(__('Back to table'));
});

it('can pay all items of an order', function () {
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

    $response = $this->post(route('checkout.pay', $order->id), [
        'all' => true,
    ]);

    $response->assertRedirectToRoute('table.index');
    $this->assertTrue($table->currentOrder->isEmpty());
});

it('can pay some items of a table (split-payment)', function () {
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
    $paidOrderItem = \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
        'split' => 0,
    ]);
    $unpaidOrderItem = \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
    ]);
    $secondUnpaidOrderItem = \App\Models\OrderItem::create([
        'order_id' => $order->id,
        'item_id' => $wine->id,
    ]);
    $response = $this->post(route('checkout.pay', $order->id), [
        'items' => [
            ['id' => $unpaidOrderItem->id],
        ],
    ]);

    $response->assertRedirectToRoute('table.index');
    $this->assertTrue($table->currentOrder->isNotEmpty());
});
