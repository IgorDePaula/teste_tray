<?php

use Tray\Sells\Application\Dto\SellDto;

it('should get instance sell dto', function ($amount, $commission, $seller) {
    $dto = SellDto::fromArray(['amount' => $amount, 'commission' => $commission, 'seller' => $seller]);
    expect($dto)->toBeInstanceOf(SellDto::class);
})->with('sells');

it('should get array sell dto', function ($amount, $commission, $seller) {
    $dto = new SellDto($amount, $commission, $seller);
    expect($dto->toArray())->toBeArray()
        ->and($dto->toArray()['amount'])->toBe($amount)
        ->and($dto->toArray()['commission'])->toBe($commission);
})->with('sells');
