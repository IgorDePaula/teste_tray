<?php

use Tray\Core\Application\ActionFactory;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Infrastructure\Http\Controller\CreateSellerController;
use Tray\Sellers\Infrastructure\Http\Request\CreateSellerRequest;

it('should create a Seller', function ($name, $email, $commission) {
    $dtoMock = Mockery::mock(SellerDto::class)
        ->shouldReceive('toArray')->andReturn(['name' => $name, 'email' => $email, 'commission' => $commission])->getMock();
    $requestMock = Mockery::mock(CreateSellerRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::success($dtoMock))->getMock();

    $controller = new CreateSellerController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(201);
})->with('sellers');


it('should receive a bad request on create a Seller', function ($name, $email, $commission) {
    $dtoMock = Mockery::mock(SellerDto::class)
        ->shouldReceive('toArray')->andReturn(['name' => $name, 'email' => $email, 'commission' => $commission])->getMock();
    $requestMock = Mockery::mock(CreateSellerRequest::class);
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::fail(new InfrastructureError()))->getMock();

    $controller = new CreateSellerController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(400);
})->with('sellers');


it('should receive an internal server error on create a Seller', function ($name, $email, $commission) {
    $dtoMock = Mockery::mock(SellerDto::class)
        ->shouldReceive('toArray')->andReturn(['name' => $name, 'email' => $email, 'commission' => $commission])->getMock();
    $requestMock = Mockery::mock(CreateSellerRequest::class);
    $infraError = new InfrastructureError();
    $requestMock->shouldReceive('toDto')->once()->andReturn($dtoMock);
    $factoryMock = Mockery::mock(ActionFactory::class)
        ->shouldReceive('makeAction')->andReturn(Result::fail($infraError))->getMock();

    $controller = new CreateSellerController($factoryMock);

    $result = $controller($requestMock);

    expect($result->getStatusCode())->toBe(400);
})->with('sellers');
