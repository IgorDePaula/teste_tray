<?php

it('Should get collection of Seller', function ($name, $email, $commission) {
    $dto = new \Tray\Sellers\Application\Dto\SellerDto($name, $email, $commission);
    $collection = new \Tray\Sellers\Shared\SellerCollection([$dto]);
    expect($collection)->toHaveCount(1);
})->with('sellers');

it('Should get error with wrong type', function () {
    $number = 1;
    $collection = new \Tray\Sellers\Shared\SellerCollection([$number]);
    expect($collection)->toHaveCount(1);
})->expectException('InvalidArgumentException');
