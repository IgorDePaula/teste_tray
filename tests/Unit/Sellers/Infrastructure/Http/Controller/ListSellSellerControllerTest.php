<?php

use Tray\Core\Application\ActionFactory;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\ListSellsSellerDto;
use Tray\Sellers\Infrastructure\Http\Controller\ListSellSellerController;
use Tray\Sellers\Infrastructure\Http\Request\ListSellSellerRequest;
use Tray\Sells\Infrastructure\Error\NotFound;

it('should list sell Seller', function () {
    $dtoMock = Mockery::mock(ListSellsSellerDto::class)
        ->shouldReceive('toArray')->andReturn(['id' => 1])->getMock();
    $requestMock = Mockery::mock(ListSellSellerRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::success($dtoMock))->getMock();

    $controller = new ListSellSellerController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(200);
});

it('should not found list sell seller', function () {
    $dtoMock = Mockery::mock(ListSellsSellerDto::class)
        ->shouldReceive('toArray')->andReturn(['id' => 1])->getMock();
    $requestMock = Mockery::mock(ListSellSellerRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::fail(new NotFound()))->getMock();

    $controller = new ListSellSellerController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(404);
});
