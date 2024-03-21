<?php

use Tray\Core\Domain\Director\DirectorInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Action\ListSellFromSellerAction;
use Tray\Sellers\Application\Dto\{ListSellsSellerDto, SellResponseDto};
use Tray\Sellers\Domain\Entity\ListSellSellerEntity;
use Tray\Sellers\Shared\ListSellSellerCollection;


it('sould get list of sells from seller', function () {

    $repositoryMock = Mockery::mock(SellerRepositoryInterface::class)
        ->shouldReceive('findSeller')
        ->andReturn(Result::success(new SellerMock()))
        ->getMock();

    $directoryMock = Mockery::mock(DirectorInterface::class)
        ->shouldReceive('make')
        ->andReturn(new ListSellSellerEntity(1, 'Test', 'email', 12.9, 4.3, 'date'))
        ->getMock();

    $mapperMock = Mockery::mock(MapperInterface::class)
        ->shouldReceive('toDto')
        ->andReturn(new SellResponseDto(1, 'Test', 'email', 12.9, 4.3, new DateTime()))
        ->getMock();


    $action = new ListSellFromSellerAction($repositoryMock, $directoryMock, new ListSellSellerCollection(), $mapperMock);
    $result = $action(new ListSellsSellerDto(1));

    expect($result)->toBeInstanceOf(Result::class)
        ->and($result->getValue())->toBeInstanceOf(ListSellSellerCollection::class)
        ->and($result->getValue())->toHaveCount(1)
        ->and($result->getValue()->first())->toBeInstanceOf(SellResponseDto::class);
});


class SellerMock
{
    public $id = 1;

    public function __get(string $name)
    {
        if ($name == 'sells') {
            return [new class {
                public function load()
                {
                    //
                }

                public function toArray()
                {
                    return [
                        'id' => 1,
                        'amount' => 5.6,
                        'commission' => 4.3,
                        'sold_at' => new DateTime()
                    ];
                }
            }];
        }
    }

    public function toArray()
    {
        return [
            'id' => 1,
            'amount' => 5.6,
            'commission' => 4.3,
            'sold_at' => new DateTime(),
            'seller' => [
                'id' => 1,
                'name' => 'Test',
                'email' => 'email',
            ]
        ];
    }
}
