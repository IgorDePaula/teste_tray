<?php

use Tray\Sellers\Domain\Entity\SellerEntity;
use Tray\Sellers\Shared\SellerCollection;

it('Should get collection of Seller', function ($name, $email, $commission) {
    $dto = new SellerEntity(id: 1, name: $name, email: $email, commission: $commission);
    $collection = new SellerCollection([$dto]);
    expect($collection)->toHaveCount(1);
})->with('sellers');

it('Should get error with wrong type', function () {
    $number = 1;
    $collection = new SellerCollection([$number]);
    expect($collection)->toHaveCount(1);
})->expectException('InvalidArgumentException');
