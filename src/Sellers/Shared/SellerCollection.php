<?php

namespace Tray\Sellers\Shared;

use Tray\Core\Shared\Collection;
use Tray\Sellers\Domain\Entity\SellerEntity;

class SellerCollection extends Collection
{
    protected string $allowedType = SellerEntity::class;

    public function toArray(): array
    {
        return array_map(fn($item) => $item->toArray(), $this->items);
    }
}
