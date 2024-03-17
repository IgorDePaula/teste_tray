<?php

namespace Tray\Sellers\Shared;

use Tray\Core\Shared\Collection;
use Tray\Sellers\Application\Dto\SellerDto;

class SellerCollection extends Collection
{
    protected string $allowedType = SellerDto::class;
}
