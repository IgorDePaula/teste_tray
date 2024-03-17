<?php

namespace Tray\Core\Infrastructure\Repository;

use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;

interface SellerRepositoryInterface
{
    public function createSeller(SellerDto $sellerDto): Result;

    public function list(): Result;
}
