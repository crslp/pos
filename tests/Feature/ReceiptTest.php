<?php

it('has receipt page', function () {
    $response = $this->get('/receipt');

    $response->assertStatus(200);
});

it('shows a list of receipts', function () {
    \App\Models\Receipt::factory()->create([
        'table' => 1,
        'total' => 19.99,
    ]);
    \App\Models\Receipt::factory()->create([
        'table' => 3,
        'total' => 99.99,
    ]);
    $response = $this->get('/receipt');

    $response->assertSee('19.99');
    $response->assertSee('99.99');
    $response->assertStatus(200);
});
