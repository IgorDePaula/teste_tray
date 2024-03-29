<?php

namespace Tray\Sellers\Application\Dto;

use Tray\Core\Application\AbstractDto;

class SellerDto extends AbstractDto
{
    public function __construct(public readonly string $name, public readonly string $email, public readonly ?float $commission = 0.0)
    {

    }

    static public function fromArray(array $data): static
    {
        return new static(name: $data['name'], email: $data['email'], commission: $data['commission'] ?? 0.0);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'commission' => $this->commission
        ];
    }
}
