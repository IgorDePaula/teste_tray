<?php

use Tray\Sellers\Application\Dto\ListSellsSellerDto;

it('should get seller request dto', function () {

    $seller = new ListSellsSellerDto(1);

    expect($seller->sellerId)->toBe(1);

});


it('should get error seller request dto', function ($name, $email, $commission) {

    $seller = ListSellsSellerDto::fromArray(['id' => 1]);

    expect($seller)->toBeInstanceOf(ListSellsSellerDto::class)
        ->and($seller->sellerId)->toBe(1);

})->with('sellers');
