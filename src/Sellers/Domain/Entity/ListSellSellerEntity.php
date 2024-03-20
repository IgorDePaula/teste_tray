<?php

namespace Tray\Sellers\Domain\Entity;

use Tray\Core\Domain\Entity\EntityInterface;

class ListSellSellerEntity implements EntityInterface
{
    public function __construct(
        private readonly int    $id,
        private readonly string $name,
        private readonly string $email,
        private readonly float  $amount,
        private readonly float $commission,
        private readonly string $soldAt
    )
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCommission(): float
    {
        return $this->commission;
    }

    public function getSoldAt(): string
    {
        return $this->soldAt;
    }


    public function getId(): int
    {
        return $this->id;
    }
}
