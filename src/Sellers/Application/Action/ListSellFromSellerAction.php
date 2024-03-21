<?php

namespace Tray\Sellers\Application\Action;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Application\ActionInterface;
use Tray\Core\Domain\Director\DirectorInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Collection;
use Tray\Core\Shared\MapperInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellResponseDto;

class ListSellFromSellerAction implements ActionInterface
{
    public function __construct(
        private readonly SellerRepositoryInterface $repository,
        private readonly DirectorInterface         $director,
        private readonly Collection                $collection,
        private readonly MapperInterface           $mapper
    )
    {

    }

    public function __invoke(?AbstractDto $dto): Result
    {
        $seller = $this->repository->findSeller($dto->sellerId);

        if ($seller->isFailure()) {
            return Result::fail($seller->getValue());
        }
        $sells = $seller->getValue()->sells;
        foreach ($sells as $sell) {
            $sell->load('seller');
            $this->collection->add($this->mapper->toDto($sell, SellResponseDto::class));
        }
        return Result::success($this->collection);
    }
}
