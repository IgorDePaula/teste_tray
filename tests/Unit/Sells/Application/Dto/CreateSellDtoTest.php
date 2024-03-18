<?php

use Tray\Sells\Application\Dto\CreateSellDto;

it('should get instance create sell dto', function ($amount, $_, $seller) {
    $dto = CreateSellDto::fromArray(['seller' => $seller, 'amount' => $amount]);
    expect($dto)->toBeInstanceOf(CreateSellDto::class);
})->with('sells');

it('should get array create sell dto', function ($amount, $_, $seller) {
    $dto = new CreateSellDto(seller: $seller, amount: $amount);
    expect($dto)->toBeInstanceOf(CreateSellDto::class);
})->with('sells');

