<?php

namespace Tray\Sells\Application\Dto;

use Tray\Core\Application\AbstractDto;

class CreateSellDto extends AbstractDto
{
    public function __construct(public readonly int $seller, public readonly float $amount)
    {

    }

    static public function fromArray(array $data): static
    {
        return new static(seller: $data['seller'], amount: $data['amount']);
    }

    public function toArray(): array
    {
        return [
            'seller' => $this->seller,
            'amount' => $this->amount,
        ];
    }
}
