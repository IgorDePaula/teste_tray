<?php

namespace Tray\Sellers\Domain\Builder;

use Tray\Core\Domain\Builder\BuilderInterface;
use Tray\Core\Domain\Entity\EntityInterface;
use Tray\Sellers\Domain\Entity\SellerEntity;

class SellerBuilder implements BuilderInterface
{
    private $id, $name, $email, $commission;

    public function withId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function withCommission(float $commission): self
    {
        $this->commission = $commission;
        return $this;
    }

    public function build(): EntityInterface
    {
        return new SellerEntity(id: $this->id, name: $this->name, email: $this->email, commission: $this->commission);
    }
}
