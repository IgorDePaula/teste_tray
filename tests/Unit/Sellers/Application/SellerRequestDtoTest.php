<?php


it('should get seller request dto', function ($name, $email, $commission) {
    $seller = new \Tray\Sellers\Application\SellerRequestDto(name: $name, email: $email, commission: $commission);
    expect($seller->name)->toBe($name);
    expect($seller->email)->toBe($email);
    expect($seller->commission)->toBe($commission);
    expect($seller->toArray())->toBeArray();

})->with('sellers');
