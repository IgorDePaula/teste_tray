<?php

use Tray\Core\Application\ActionFactory;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sells\Application\Dto\CreateSellDto;
use Tray\Sells\Infrastructure\Http\Controller\CreateSellController;
use Tray\Sells\Infrastructure\Http\Request\CreateSellRequest;

it('should create a sell by controller', function ($amount, $_, $seller) {
    $dtoMock = Mockery::mock(CreateSellDto::class)
        ->shouldReceive('toArray')->andReturn(['seller' => $seller, 'amount' => $amount])->getMock();
    $requestMock = Mockery::mock(CreateSellRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::success($dtoMock))->getMock();

    $controller = new CreateSellController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(201);
})->with('sells');

it('should receive a bad request on create a Sell', function ($amount, $_, $seller) {
    $dtoMock = Mockery::mock(CreateSellDto::class)
        ->shouldReceive('toArray')->andReturn(['seller' => $seller, 'amount' => $amount])->getMock();
    $requestMock = Mockery::mock(CreateSellRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::fail(new InfrastructureError()))->getMock();

    $controller = new CreateSellController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(400);
})->with('sells');

it('should receive an internal server error on create a Seller', function ($amount, $_, $seller) {
    $dtoMock = Mockery::mock(CreateSellDto::class)
        ->shouldReceive('toArray')->andReturn(['seller' => $seller, 'amount' => $amount])->getMock();
    $requestMock = Mockery::mock(CreateSellRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::fail(new Exception()))->getMock();

    $controller = new CreateSellController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(500);
})->with('sells');
