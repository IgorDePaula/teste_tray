<?php

namespace Tray\Sells\Shared;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Domain\Entity\EntityInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Sells\Application\Dto\SellDto;
use Tray\Sells\Application\Dto\SellerDto;

class SellMapper implements MapperInterface
{

    public function toDto($data, ?string $convertTo = null): AbstractDto
    {
        return match ($convertTo) {
            SellDto::class => new SellDto(...$data),
            SellerDto::class => new SellerDto(...$data)
        };
    }

    public function toPersistence(AbstractDto $data): array
    {
        $array = $data->toArray();
        return [
            ...$array,
            'seller_id' => $data['seller']
        ];
    }

    public function toDomain(array $data): AbstractDto|EntityInterface
    {
        throw new \Exception('Not Implemented');
    }
}
