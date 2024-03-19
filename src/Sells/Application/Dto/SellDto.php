<?php

namespace Tray\Sells\Application\Dto;

use Tray\Core\Application\AbstractDto;

class SellDto extends AbstractDto
{

    public function __construct(public readonly float $amount, public readonly float $commission, public readonly int $seller)
    {

    }

    static public function fromArray(array $data): static
    {
        return new static(amount: $data['amount'], commission: $data['commission'], seller: $data['seller']);
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'commission' => $this->commission,
            'seller' => $this->seller,
        ];
    }
}
