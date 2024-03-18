<?php

use Tray\Core\Application\ActionFactory;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\ListSellerDto;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Infrastructure\Http\Controller\ListSellersController;
use Tray\Sellers\Infrastructure\Http\Request\ListSellersRequest;

it('should list sellers by controller', function () {
    $requestMock = Mockery::mock(ListSellersRequest::class);
    $dtoMock = new ListSellerDto();
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::success($dtoMock))->getMock();

    $controller = new ListSellersController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(200);
});

it('should receive a service unavailable error when trying to list sellers', function ($name, $email, $commission) {

    $dtoMock = Mockery::mock(ListSellerDto::class)
        ->shouldReceive('toArray')->andReturn(['name' => $name, 'email' => $email, 'commission' => $commission])->getMock();
    $requestMock = Mockery::mock(ListSellersRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::fail(new InfrastructureError()))->getMock();

    $controller = new ListSellersController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(503);

})->with('sellers');


it('should receive an internal server error on create a Seller', function ($name, $email, $commission) {
    $dtoMock = Mockery::mock(ListSellerDto::class)
        ->shouldReceive('toArray')->andReturn(['name' => $name, 'email' => $email, 'commission' => $commission])->getMock();
    $requestMock = Mockery::mock(ListSellersRequest::class);
    $infraError = new InfrastructureError();
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::fail($infraError))->getMock();

    $controller = new ListSellersController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(503);
})->with('sellers');
