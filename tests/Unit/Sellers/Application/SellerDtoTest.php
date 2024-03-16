<?php

use Tray\Sellers\Application\Dto\SellerDto;

it('should get seller request dto', function ($name, $email, $commission) {

    $seller = new SellerDto(name: $name, email: $email, commission: $commission);

    expect($seller->name)->toBe($name)
        ->and($seller->email)->toBe($email)
        ->and($seller->commission)->toBe($commission)
        ->and($seller->toArray())->toBeArray()
        ->and($seller->toArray()['name'])->toBe($name)
        ->and($seller->toArray()['email'])->toBe($email)
        ->and($seller->toArray()['commission'])->toBe($commission);

})->with('sellers');
