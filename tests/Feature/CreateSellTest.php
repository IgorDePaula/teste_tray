<?php

it('has createsell page', function () {
    $seller = \App\Models\Seller::factory()->create();

    $data = [
        'seller' => $seller->id,
        'amount' => 56.7
    ];
    $response = $this->post('/api/sell', $data);

    $response->assertStatus(201);
});
