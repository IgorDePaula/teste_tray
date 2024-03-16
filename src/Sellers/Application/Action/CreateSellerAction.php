<?php

namespace Tray\Sellers\Application\Action;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Application\ActionInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;

class CreateSellerAction implements ActionInterface
{
    public function __construct(private readonly SellerRepositoryInterface $sellerRepository)
    {

    }

    public function __invoke(?AbstractDto $dto): Result
    {
        return $this->sellerRepository->createSeller($dto);
    }
}
