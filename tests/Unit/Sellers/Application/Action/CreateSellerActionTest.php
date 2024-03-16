<?php

use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Action\CreateSellerAction;
use Tray\Sellers\Application\Dto\SellerDto;

it('should create Sale action', function ($name, $email, $commission) {

    $repositoryMock = Mockery::mock(SellerRepositoryInterface::class)
        ->shouldReceive('createSeller')
        ->andReturn(Result::success([]))
        ->getMock();

    $createAction = new CreateSellerAction($repositoryMock);
    $dtoModk = new SellerDto(name: $name, email: $email, commission: $commission);
    $response = $createAction($dtoModk);
    expect($response)->toBeInstanceOf(Result::class)
        ->and($response->isSuccess())->toBeTrue();
})->with('sellers');
