<?php

use App\Models\Seller;

it('has listsellers page', function () {
    Seller::factory(1)->create();
    $response = $this->get('/api/sellers');

    $response->assertOk();
    expect($response->original['success'])->toBeTrue()
        ->and($response->original['data'])->toHaveCount(1);
});
