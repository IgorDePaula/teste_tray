<?php

namespace Tray\Sellers\Shared;

use Exception;
use Tray\Core\Application\AbstractDto;
use Tray\Core\Domain\AggregateInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Sellers\Application\Dto\SellResponseDto;

class SellerMapper implements MapperInterface
{

    public function toDto($data, ?string $convertTo = null): AbstractDto
    {
        return match ($convertTo) {
            SellResponseDto::class => $this->toSellResposeDto($data)
        };
    }

    public function toPersistence(AbstractDto $data): array
    {
        throw new Exception("Not Implemented");
    }

    public function toDomain(AbstractDto $dto): AggregateInterface
    {
        throw new Exception("Not Implemented");
    }

    private function toSellResposeDto($sell): SellResponseDto
    {
        return SellResponseDto::fromArray([
            'id' => $sell->id,
            'name' => $sell->seller->name,
            'email' => $sell->seller->email,
            'commission' => $sell->commission,
            'amount' => $sell->amount,
            'created_at' => $sell->created_at,
        ]);
    }
}
