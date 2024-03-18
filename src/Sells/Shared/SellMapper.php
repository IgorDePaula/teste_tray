<?php

namespace Tray\Sells\Shared;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Domain\Entity\EntityInterface;
use Tray\Core\Shared\MapperInterface;

class SellMapper implements MapperInterface
{

    public function toDto($data, ?string $convertTo = null): AbstractDto
    {
        throw new \Exception('Not Implemented');
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
