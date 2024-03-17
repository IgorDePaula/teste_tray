<?php

use Tray\Sellers\Domain\Director\SellerDirector;
use Tray\Sellers\Domain\Entity\SellerEntity;

it('should build a seller entity with Seller director', function ($name, $email, $commission) {
    $data = [
        'id' => 1,
        'name' => $name,
        'email' => $email,
        'commission' => $commission
    ];

    $diretor = new SellerDirector();
    $result = $diretor->make($data);

    expect($result)->toBeInstanceOf(SellerEntity::class)
        ->and($result->getId())->toBe(1)
        ->and($result->getName())->toBe($name)
        ->and($result->getEmail())->toBe($email)
        ->and($result->getCommission())->toBe($commission);

})->with('sellers');
