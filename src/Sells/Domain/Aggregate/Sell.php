<?php

namespace Tray\Sells\Domain\Aggregate;

use Tray\Core\Domain\AggregateInterface;
use Tray\Sells\Application\Dto\SellDto;
use Tray\Sells\Application\Dto\SellerDto;

class Sell implements AggregateInterface
{

    public function __construct(private readonly SellDto $sell)
    {

    }

    public function calculateCommission(SellerDto $seller): float
    {
        return ($this->sell->amount * $seller->commission) / 100;
    }
}
