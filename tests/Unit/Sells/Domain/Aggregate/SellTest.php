<?php

use Tray\Sells\Application\Dto\{SellDto, SellerDto};
use Tray\Sells\Domain\Aggregate\Sell;

it('should calculate commission', function () {

    $sellerDto = new SellerDto(1, 'Test', 'email@test.com', 8.5);

    $sellDto = new SellDto(120, 0.0, 1);

    $sell = new Sell($sellDto);

    expect($sell->calculateCommission($sellerDto))->toBe(10.2);

});
