<?php

namespace Tray\Sells\Application\Dto;

use Tray\Core\Application\AbstractDto;

class SellerDto extends AbstractDto
{
    public function __construct(
        public readonly int    $id,
        public readonly string $name,
        public readonly string $email,
        public readonly float  $commission
    )
    {

    }

    static public function fromArray(array $data): static
    {
        return new static($data['id'], $data['name'], $data['email'], $data['commission'] ?? 0.0);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'commission' => $this->commission,
        ];
    }
}
