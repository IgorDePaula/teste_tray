<?php

namespace Tray\Sellers\Application\Dto;

use Tray\Core\Application\AbstractDto;

class ListSellerDto extends AbstractDto
{

    static public function fromArray(array $data): static
    {
        return new static();
    }

    public function toArray(): array
    {
        return [];
    }
}
