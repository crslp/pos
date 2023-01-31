<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('has receipt page', function () {
    $response = $this->get('/receipt');

    $response->assertStatus(200);
});

it('shows a list of receipts', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $order = \App\Models\Order::create(['table_id' => $table->id]);
    \App\Models\Receipt::factory()->create([
        'table_id' => $table->id,
        'order_id' => $order->id,
        'total' => 19.99,
    ]);

    $response = $this->get(route('receipt.index'));
    $response->assertSee('19.99');
    $response->assertSee("Table {$table->name}");
    $response->assertStatus(200);
});

it('has receipt items', function () {
    $table = \App\Models\Table::create(['name' => 'One']);
    $order = \App\Models\Order::create(['table_id' => $table->id]);
    $receipt = \App\Models\Receipt::factory()->create([
        'table_id' => $table->id,
        'order_id' => $order->id,
        'total' => 19.99,
    ]);
    \App\Models\ReceiptItem::factory()->create([
        'receipt_id' => $receipt->id,
        'price' => 3.99,
        'name' => 'Milk',
        'split' => 1,
    ]);
    \App\Models\ReceiptItem::factory()->create([
        'receipt_id' => $receipt->id,
        'price' => 1.89,
        'name' => 'Coffee',
        'split' => 1,
    ]);
    \App\Models\ReceiptItem::factory()->create([
        'receipt_id' => $receipt->id,
        'price' => 9.59,
        'name' => 'Spaghetti',
        'split' => 2,
    ]);

    $response = $this->get(route('receipt.show', ['receipt' => $receipt->id]));

    $response->assertSee('Coffee');
    $response->assertSee('3.99');
    $response->assertSee('Milk');
    $response->assertSee('1.89');
    $response->assertSee('Spaghetti');
    $response->assertSee('9.59');
    $response->assertSee('Split 2');
    $response->assertStatus(200);
});
