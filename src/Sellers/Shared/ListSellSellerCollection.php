<?php

namespace Tray\Sellers\Shared;

use Tray\Core\Shared\Collection;
use Tray\Sellers\Application\Dto\SellResponseDto;

class ListSellSellerCollection extends Collection
{
    protected string $allowedType = SellResponseDto::class;
}
