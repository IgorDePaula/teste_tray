<?php

namespace Tray\Sellers\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;

class SellerRepository implements SellerRepositoryInterface
{
    public function __construct(private readonly Model $model)
    {

    }

    public function createSeller(SellerDto $sellerDto): Result
    {
        $result = $this->model->create($sellerDto->toArray());
        if (!property_exists($result, 'id') && empty($result->id)) {
            return Result::fail('Error creating seller');
        }
        return Result::success($result);
    }
}
