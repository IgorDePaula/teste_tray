<?php

use Tray\Sellers\Domain\Director\ListSellSellerDirector;
use Tray\Sellers\Domain\Entity\ListSellSellerEntity;

it('sould direct a sell seller entity', function () {
    $data = [
        'id' => 1,
        'name' => 'Test',
        'email' => 'email@email.com',
        'commission' => 1.5,
        'soldAt' => '20/04/2024',
        'amount' => 10.5
    ];

    $diretor = new ListSellSellerDirector();
    $result = $diretor->make($data);

    expect($result)->toBeInstanceOf(ListSellSellerEntity::class)
        ->and($result->getId())->toBe(1)
        ->and($result->getName())->toBe('Test')
        ->and($result->getEmail())->toBe('email@email.com')
        ->and($result->getCommission())->toBe(1.5)
        ->and($result->getAmount())->toBe(10.5)
        ->and($result->getSoldAt())->toBe('20/04/2024');
});
