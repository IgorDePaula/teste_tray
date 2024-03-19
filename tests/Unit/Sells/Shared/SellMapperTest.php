<?php

use Tray\Sells\Application\Dto\{SellDto, SellerDto};
use Tray\Sells\Shared\SellMapper;

it('should mapper seller to seller dto', function () {
    $data = [
        'id' => 1,
        'name' => 'test',
        'email' => 'email@email.co',
        'commission' => 8.5
    ];
    $mapper = new SellMapper();
    expect($mapper->toDto($data, SellerDto::class))->toBeInstanceOf(SellerDto::class);

});


it('should mapper sell to sell dto', function () {
    $data = [
        'amount' => 12.6,
        'commission' => 1,
        'seller' => 1
    ];
    $mapper = new SellMapper();
    expect($mapper->toDto($data, SellDto::class))->toBeInstanceOf(SellDto::class);
});
