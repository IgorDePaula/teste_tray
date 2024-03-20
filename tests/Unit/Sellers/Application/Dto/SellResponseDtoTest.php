<?php

use Tray\Sellers\Application\Dto\SellResponseDto;


it('should get seller request dto', function () {

    $sellResponse = new SellResponseDto(id: 1, name: 'John', email: 'email@email.com', amount: 120.5, commission: 10.5, dateSell: new DateTime('2024-07-06'));

    expect($sellResponse->name)->toBe('John')
        ->and($sellResponse->email)->toBe('email@email.com')
        ->and($sellResponse->id)->toBe(1)
        ->and($sellResponse->commission)->toBe(10.5)
        ->and($sellResponse->dateSell)->toBeInstanceOf(DateTime::class)
        ->and($sellResponse->amount)->toBe(120.5)
        ->and($sellResponse->toArray())->toBeArray()
        ->and($sellResponse->toArray()['name'])->toBe('John')
        ->and($sellResponse->toArray()['id'])->toBe(1)
        ->and($sellResponse->toArray()['email'])->toBe('email@email.com')
        ->and($sellResponse->toArray()['commission'])->toBe(10.5)
        ->and($sellResponse->toArray()['sold_at'])->toBe('06/07/2024')
        ->and($sellResponse->toArray()['amount'])->toBe(120.5);

});

