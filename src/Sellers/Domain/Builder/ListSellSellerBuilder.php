<?php

namespace Tray\Sellers\Domain\Builder;

use Tray\Core\Domain\Builder\BuilderInterface;
use Tray\Core\Domain\Entity\EntityInterface;
use Tray\Sellers\Domain\Entity\ListSellSellerEntity;

class ListSellSellerBuilder implements BuilderInterface
{

    private $id, $name, $email, $amount, $comission, $soldAt;

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

    public function withAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function withComission(float $comission): self
    {
        $this->comission = $comission;
        return $this;
    }

    public function withSoldAt(string $soldAt): self
    {
        $this->soldAt = $soldAt;
        return $this;
    }

    public function build(): EntityInterface
    {
        return new ListSellSellerEntity($this->id, $this->name, $this->email, $this->amount, $this->comission, $this->soldAt);
    }
}
