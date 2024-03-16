<?php

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Infrastructure\Repository\SellerRepository;

it('should create a seller', function ($name, $email, $commission) {

    $resultMock = new \stdClass();
    $resultMock->id = 1;
    $modelMock = Mockery::mock(Model::class)
        ->shouldReceive('create')
        ->andReturn($resultMock)->getMock();
    $dtoModk = new SellerDto(name: $name, email: $email, commission: $commission);

    $repository = new SellerRepository($modelMock);

    expect($repository->createSeller($dtoModk))->toBeInstanceOf(Result::class)
        ->and($repository->createSeller($dtoModk)->isSuccess())->toBeTrue();

})->with('sellers');


it('should get an error on create a seller', function ($name, $email, $commission) {

    $resultMock = new \stdClass();
    $modelMock = Mockery::mock(Model::class)
        ->shouldReceive('create')
        ->andReturn($resultMock)->getMock();
    $dtoModk = new SellerDto(name: $name, email: $email, commission: $commission);

    $repository = new SellerRepository($modelMock);

    expect($repository->createSeller($dtoModk))->toBeInstanceOf(Result::class)
        ->and($repository->createSeller($dtoModk)->isFailure())->toBeTrue()
        ->and($repository->createSeller($dtoModk)->getValue())->toBeInstanceOf(InfrastructureError::class);

})->with('sellers');
