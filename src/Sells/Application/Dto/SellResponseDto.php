<?php

namespace Tray\Sells\Application\Dto;

use Tray\Core\Application\AbstractDto;

class SellResponseDto extends AbstractDto
{

    public function __construct(
        public readonly int       $id,
        public readonly string    $name,
        public readonly string    $email,
        public readonly float     $amount,
        public readonly float     $commission,
        public readonly \DateTime $dateSell
    )
    {

    }

    static public function fromArray(array $data): static
    {
        return new static($data['id'], $data['name'], $data['email'], $data['amount'], $data['commission'], $data['created_at']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'amount' => $this->amount,
            'commission' => $this->commission,
            'sold_at' => $this->dateSell->format('d/m/Y H:i:s'),
        ];
    }
}
