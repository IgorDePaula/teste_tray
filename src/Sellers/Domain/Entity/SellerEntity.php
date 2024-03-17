<?php

namespace Tray\Sellers\Domain\Entity;

use Tray\Core\Application\ArrayableInterface;
use Tray\Core\Domain\Entity\EntityInterface;

class SellerEntity implements EntityInterface, ArrayableInterface
{

    public function __construct(
        private readonly int    $id,
        private readonly string $name,
        private readonly string $email,
        private readonly float  $commission
    )
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCommission(): float
    {
        return $this->commission;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'commission' => $this->commission,
        ];
    }
}
