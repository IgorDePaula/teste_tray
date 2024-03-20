<?php

namespace Tray\Sellers\Shared;

use Tray\Core\Shared\Collection;
use Tray\Sellers\Application\Dto\SellResponseDto;

class ListSellSellerCollection extends Collection
{
    protected string $allowedType = SellResponseDto::class;

    public function toArray(): array
    {
        return array_map(function ($item) {
            return $item->toArray();
        }, $this->items);
    }
}
