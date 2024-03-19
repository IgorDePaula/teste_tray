<?php

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sells\Application\Dto\SellDto;
use Tray\Sells\Infrastructure\Repository\SellRepository;
use Tray\Sells\Shared\SellMapper;

it('should create an sell', function ($amount, $commission, $seller) {
    $dto = new SellDto($amount, $commission, $seller);
    $resultMock = new \stdClass();
    $resultMock->id = 1;
    $modelMock = \Mockery::mock(Model::class)
        ->shouldReceive('create')
        ->andReturn($resultMock)
        ->getMock();

    $repository = new SellRepository($modelMock, new SellMapper());
    $result = $repository->createSell($dto);
    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isSuccess())->toBeTrue();

})->with('sells');


it('should get error on create an sell', function ($amount, $commission, $seller) {
    $dto = new SellDto($amount, $commission, $seller);
    $resultMock = new \stdClass();
    $modelMock = \Mockery::mock(Model::class)
        ->shouldReceive('create')
        ->andReturn($resultMock)
        ->getMock();

    $repository = new SellRepository($modelMock, new SellMapper());
    $result = $repository->createSell($dto);
    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isFailure())->toBeTrue()
        ->and($result->getValue())->toBeInstanceOf(InfrastructureError::class);

})->with('sells');
