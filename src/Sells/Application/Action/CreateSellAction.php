<?php

namespace Tray\Sells\Application\Action;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Application\ActionInterface;
use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\Result;

class CreateSellAction implements ActionInterface
{
    public function __construct(private readonly SellRepositoryInterface $repository)
    {

    }

    public function __invoke(?AbstractDto $dto): Result
    {
        return $this->repository->createSell($dto);
    }
}
