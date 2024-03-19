<?php

it('has create sell page', function () {
    $seller = \App\Models\Seller::factory()->create();
    $data = [
        'seller' => $seller->id,
        'amount' => 56.7
    ];
    $response = $this->post('/api/sell', $data);
    $response->assertStatus(201);
});

it('has not found seller on create sell', function () {

    $data = [
        'seller' => 3,
        'amount' => 56.7
    ];
    $response = $this->post('/api/sell', $data);
    $response->assertStatus(404)
        ->assertSeeText('Seller Not Found');
});
