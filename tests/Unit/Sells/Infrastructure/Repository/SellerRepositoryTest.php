<?php

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Shared\Result;
use Tray\Sells\Infrastructure\Repository\SellerRepository;

it('should find a seller', function () {
    $resultMock = new \stdClass();
    $resultMock->id = 1;
    $modelMock = \Mockery::mock(Model::class)
        ->shouldReceive('find')
        ->andReturn($resultMock)
        ->getMock();

    $repository = new SellerRepository($modelMock);
    $result = $repository->findSeller(1);
    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isSuccess())->toBeTrue();

});


it('should not found a seller', function () {
    $modelMock = \Mockery::mock(Model::class)
        ->shouldReceive('find')
        ->andReturn(new Exception())
        ->getMock();

    $repository = new SellerRepository($modelMock);
    $result = $repository->findSeller(1);
    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isFailure())->toBeTrue();

});
