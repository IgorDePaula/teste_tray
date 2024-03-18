<?php

use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sells\Application\Action\CreateSellAction;
use Tray\Sells\Application\Dto\SellDto;

it('should create Sell action', function ($amount, $commission) {

    $repositoryMock = Mockery::mock(SellRepositoryInterface::class)
        ->shouldReceive('createSell')
        ->andReturn(Result::success([]))
        ->getMock();

    $createAction = new CreateSellAction($repositoryMock);
    $dtoModk = new SellDto(amount: $amount, commission: $commission);
    $response = $createAction($dtoModk);
    expect($response)->toBeInstanceOf(Result::class)
        ->and($response->isSuccess())->toBeTrue();
})->with('sells');


it('should get error on create Sell action', function ($amount, $commission) {

    $repositoryMock = Mockery::mock(SellRepositoryInterface::class)
        ->shouldReceive('createSell')
        ->andReturn(Result::fail(new InfrastructureError()))
        ->getMock();

    $createAction = new CreateSellAction($repositoryMock);
    $dtoModk = new SellDto(amount: $amount, commission: $commission);
    $response = $createAction($dtoModk);
    expect($response)->toBeInstanceOf(Result::class)
        ->and($response->isFailure())->toBeTrue()
        ->and($response->getValue())->toBeInstanceOf(InfrastructureError::class);
})->with('sells');
