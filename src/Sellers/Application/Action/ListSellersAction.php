<?php

namespace Tray\Sellers\Application\Action;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Application\ActionInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;

class ListSellersAction implements ActionInterface
{
    public function __construct(private readonly SellerRepositoryInterface $sellerRepository)
    {

    }

    public function __invoke(?AbstractDto $dto = null): Result
    {
        return $this->sellerRepository->list();
    }
}
