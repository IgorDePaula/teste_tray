<?php

use Tray\Sellers\Domain\Builder\ListSellSellerBuilder;
use Tray\Sellers\Domain\Entity\ListSellSellerEntity;

it('should build an list sell seller', function () {

    $builder = new ListSellSellerBuilder();
    $builder->withId(1);
    $builder->withName('Teste');
    $builder->withEmail('email@emal.com');
    $builder->withAmount(10.5);
    $builder->withCommission(80);
    $builder->withSoldAt('30/04/2024');

    expect($builder->build())->toBeInstanceOf(ListSellSellerEntity::class);
});
