<?php

namespace Tray\Sellers\Domain\Entity;

use Tray\Core\Domain\Entity\EntityInterface;

class SellerEntity implements EntityInterface
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

    public function getCommission(): string
    {
        return $this->commission;
    }

}
