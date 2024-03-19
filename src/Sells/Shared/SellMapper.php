<?php

namespace Tray\Sells\Shared;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Domain\AggregateInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Sells\Application\Dto\SellDto;
use Tray\Sells\Application\Dto\SellerDto;
use Tray\Sells\Application\Dto\SellResponseDto;
use Tray\Sells\Domain\Aggregate\Sell;

class SellMapper implements MapperInterface
{

    public function toDto($data, ?string $convertTo = null): AbstractDto
    {
        return match ($convertTo) {
            SellDto::class => SellDto::fromArray($data),
            SellerDto::class => SellerDto::fromArray($data),
            SellResponseDto::class => $this->convertToSellResponseTo($data),
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

    public function toDomain(AbstractDto $dto): AggregateInterface
    {
        $convertTo = get_class($dto);
        return match ($convertTo) {
            SellDto::class => new Sell($dto),
        };
    }

    private function convertToSellResponseTo($data)
    {
        return SellResponseDto::fromArray([
            'id' => $data->id,
            'name' => $data->seller->name,
            'email' => $data->seller->email,
            'amount' => $data->amount,
            'commission' => $data->commission,
            'created_at' => $data->created_at,
        ]);
    }
}
