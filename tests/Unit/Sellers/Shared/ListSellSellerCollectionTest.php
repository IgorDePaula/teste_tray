<?php

use Tray\Sellers\Application\Dto\SellResponseDto;
use Tray\Sellers\Shared\ListSellSellerCollection;

it('Should get collection of sell seller', function ($name, $email, $commission) {
    $dto = new SellResponseDto(id: 1, name: $name, email: $email, amount: 10.2, commission: $commission, dateSell: new DateTime('2024-04-20'));
    $collection = new ListSellSellerCollection([$dto]);
    expect($collection)->toHaveCount(1);
})->with('sellers');

it('Should get error with wrong type', function () {
    $number = 1;
    $collection = new ListSellSellerCollection([$number]);
    expect($collection)->toHaveCount(1);
})->expectException('InvalidArgumentException');
