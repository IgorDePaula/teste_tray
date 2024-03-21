<?php

it('has listsellsellerfeature page 200', function () {
    $sell = \App\Models\Sell::factory()->create();
    $sell->load('seller');
    $response = $this->get("/api/sellers/{$sell->seller->id}/sells");

    $response->assertStatus(200);
});

it('has listsellsellerfeature page 404', function () {

    $response = $this->get("/api/sellers/2/sells");

    $response->assertStatus(404);
});
