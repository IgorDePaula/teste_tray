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
            SellResponseDto::class => SellResponseDto::fromArray($data)
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
}
