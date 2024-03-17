<?php

use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Action\ListSellersAction;
use Tray\Sellers\Domain\Entity\SellerEntity;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Shared\SellerCollection;

it('should list sellers', function ($name, $email, $commission) {
    $entity = new SellerEntity(1, $name, $email, $commission);
    $collection = SellerCollection::make([$entity]);
    $repositoryMock = Mockery::mock(SellerRepositoryInterface::class)
        ->shouldReceive('list')
        ->andReturn(Result::success($collection))
        ->getMock();

    $list = new ListSellersAction($repositoryMock);
    $result = $list();
    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->isSuccess())->toBeTrue()
        ->and($result->getValue()->count())->toBe(1);
})->with('sellers');


it('should get error on list sellers', function () {

    $repositoryMock = Mockery::mock(SellerRepositoryInterface::class)
        ->shouldReceive('list')
        ->andReturnUsing(function () {
            return Result::fail(new InfrastructureError('Database Error'));
        }, function () {
            throw new Exception('Database Error');
        })->getMock();
    $result = $repositoryMock->list();
    expect($result->isFailure())->toBeTrue()
        ->and($result->getValue())->toBeInstanceOf(Exception::class)
        ->and($result->getValue()->getMessage())->toBe('Database Error');
});
