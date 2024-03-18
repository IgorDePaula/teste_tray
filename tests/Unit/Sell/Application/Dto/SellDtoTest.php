<?php

use Tray\Sells\Application\Dto\SellDto;

it('should get instance sell dto', function ($amount, $commission) {
    $dto = SellDto::fromArray(['amount' => $amount, 'commission' => $commission]);
    expect($dto)->toBeInstanceOf(SellDto::class);
})->with('sells');

it('should get array sell dto', function ($amount, $commission) {
    $dto = new SellDto($amount, $commission);
    expect($dto->toArray())->toBeArray()
        ->and($dto->toArray()['amount'])->toB($amount)
        ->and($dto->toArray()['commission'])->toBe($commission);
})->with('sells');
