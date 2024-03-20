<?php

namespace Tray\Sellers\Application\Dto;

use Tray\Core\Application\AbstractDto;

class ListSellsSellerDto extends AbstractDto
{
    public function __construct(public readonly int $sellerId)
    {

    }

    static public function fromArray(array $data): static
    {
        return new static($data['id']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->sellerId,
        ];
    }
}
