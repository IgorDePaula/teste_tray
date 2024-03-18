<?php

namespace Tray\Core\Infrastructure\Repository;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Shared\Result;

interface SellRepositoryInterface
{
    public function createSell(AbstractDto $dto): Result;
}
