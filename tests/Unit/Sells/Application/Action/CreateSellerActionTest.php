<?php

use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sells\Application\Action\CreateSellAction;
use Tray\Sells\Application\Dto\CreateSellDto;
use Tray\Sells\Application\Dto\SellerDto;
use Tray\Sells\Infrastructure\Error\NotFound;
use Tray\Sells\Shared\SellMapper;

it('should create Sell action', function ($amount, $commission) {
    $mockSeller = new stdClass;
    $mockSeller->id = 1;
    $mockSeller->name = 'John';
    $mockSeller->email = 'email@email.com';
    $mockSell = new stdClass;
    $mockSell->id = 1;
    $mockSell->amount = $amount;
    $mockSell->commission = $commission;
    $mockSell->seller = $mockSeller;
    $mockSell->created_at = new DateTime('2022-01-01');
    $seller = SellerDto::fromArray(['id' => 1, 'name' => 'Test', 'email' => 'email@email.com', 'commission' => 8.5]);
    $sellerRepositoryMock = Mockery::mock(SellerRepositoryInterface::class)
        ->shouldReceive('findSeller')->andReturn(Result::success($seller))->getMock();
    $repositoryMock = Mockery::mock(SellRepositoryInterface::class)
        ->shouldReceive('createSell')
        ->andReturn(Result::success($mockSell))
        ->getMock();

    $createAction = new CreateSellAction($repositoryMock, $sellerRepositoryMock, new SellMapper());
    $dtoModk = new CreateSellDto(seller: 1, amount: $amount);
    $response = $createAction($dtoModk);
    expect($response)->toBeInstanceOf(Result::class)
        ->and($response->isSuccess())->toBeTrue();
})->with('sells');


it('should get error on create Sell action', function ($amount, $commission) {

    $sellerRepositoryMock = Mockery::mock(SellerRepositoryInterface::class)
        ->shouldReceive('findSeller')->andReturn(Result::fail(new NotFound()))->getMock();
    $repositoryMock = Mockery::mock(SellRepositoryInterface::class)
        ->shouldReceive('createSell')
        ->andReturn(Result::fail(new NotFound()))
        ->getMock();

    $createAction = new CreateSellAction($repositoryMock, $sellerRepositoryMock, new SellMapper());
    $dtoModk = new CreateSellDto(seller: 1, amount: $amount);
    $response = $createAction($dtoModk);
    expect($response)->toBeInstanceOf(Result::class)
        ->and($response->isFailure())->toBeTrue()
        ->and($response->getValue())->toBeInstanceOf(NotFound::class);
})->with('sells');
