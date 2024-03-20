<?php

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;
use Tray\Sellers\Domain\Director\SellerDirector;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Infrastructure\Repository\SellerRepository;
use Tray\Sellers\Shared\SellerCollection;

it('should create a seller', function ($name, $email, $commission) {

    $resultMock = new \stdClass();
    $resultMock->id = 1;
    $modelMock = Mockery::mock(Model::class)
        ->shouldReceive('create')
        ->andReturn($resultMock)->getMock();
    $dtoModk = new SellerDto(name: $name, email: $email, commission: $commission);

    $repository = new SellerRepository($modelMock, new SellerDirector());

    expect($repository->createSeller($dtoModk))->toBeInstanceOf(Result::class)
        ->and($repository->createSeller($dtoModk)->isSuccess())->toBeTrue();

})->with('sellers');


it('should get an error on create a seller', function ($name, $email, $commission) {

    $resultMock = new \stdClass();
    $modelMock = Mockery::mock(Model::class)
        ->shouldReceive('create')
        ->andReturn($resultMock)->getMock();
    $dtoModk = new SellerDto(name: $name, email: $email, commission: $commission);

    $repository = new SellerRepository($modelMock, new SellerDirector());

    expect($repository->createSeller($dtoModk))->toBeInstanceOf(Result::class)
        ->and($repository->createSeller($dtoModk)->isFailure())->toBeTrue()
        ->and($repository->createSeller($dtoModk)->getValue())->toBeInstanceOf(InfrastructureError::class);

})->with('sellers');

it('Should  get error on list sellers', function () {
    $mock = Mockery::mock(SellerRepositoryInterface::class)
        ->shouldReceive('list')
        ->andReturnUsing(function () {
            return Result::fail(new InfrastructureError('Database Error'));
        }, function () {
            throw new Exception('Database Error');
        })->getMock();

    expect($mock->list()->getValue()->getMessage())->toBe('Database Error');
});

it('should list sellers', function ($name, $email, $commission) {
    $entity = new \Tray\Sellers\Domain\Entity\SellerEntity(1, $name, $email, $commission);
    $modelMock = Mockery::mock(Model::class)
        ->shouldReceive('get')
        ->andReturn(SellerCollection::make([$entity]))
        ->getMock();


    $repository = new SellerRepository($modelMock, new SellerDirector());
    $result = $repository->list();

    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isSuccess())->toBeTrue()
        ->and($result->getValue()->count())->toBe(1)
        ->and($result->getValue()->first()->getId())->toBe(1)
        ->and($result->getValue()->first()->getName())->toBe($name)
        ->and($result->getValue()->first()->getEmail())->toBe($email)
        ->and($result->getValue()->first()->getCommission())->toBe($commission);

})->with('sellers');


it('should find a seller', function () {
    $resultMock = new \stdClass();
    $resultMock->id = 1;
    $modelMock = \Mockery::mock(Model::class)
        ->shouldReceive('find')
        ->andReturn($resultMock)
        ->getMock();

    $repository = new SellerRepository($modelMock, new SellerDirector());
    $result = $repository->findSeller(1);
    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isSuccess())->toBeTrue();

});


it('should not found a seller', function () {
    $modelMock = \Mockery::mock(Model::class)
        ->shouldReceive('find')
        ->andReturn(new Exception())
        ->getMock();

    $repository = new SellerRepository($modelMock, new SellerDirector());
    $result = $repository->findSeller(1);
    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isFailure())->toBeTrue();

});
