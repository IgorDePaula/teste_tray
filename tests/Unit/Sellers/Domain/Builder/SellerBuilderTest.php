<?php

it('should build a Seller entity', function ($name, $email, $commission) {

    $builder = new \Tray\Sellers\Domain\Builder\SellerBuilder();
    $builder->withId(1)
        ->withName($name)
        ->withEmail($email)
        ->withCommission($commission);

    $build = $builder->build();
    expect($build)->toBeInstanceOf(\Tray\Sellers\Domain\Entity\SellerEntity::class);
})->with('sellers');
