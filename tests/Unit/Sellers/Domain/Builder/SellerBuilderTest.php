<?php

use Tray\Sellers\Domain\Builder\SellerBuilder;
use Tray\Sellers\Domain\Entity\SellerEntity;

it('should build a Seller entity', function ($name, $email, $commission) {

    $builder = new SellerBuilder();
    $builder->withId(1)
        ->withName($name)
        ->withEmail($email)
        ->withCommission($commission);

    $build = $builder->build();
    expect($build)->toBeInstanceOf(SellerEntity::class);
})->with('sellers');
