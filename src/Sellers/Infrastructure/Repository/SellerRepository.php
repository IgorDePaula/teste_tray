<?php

namespace Tray\Sellers\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;

class SellerRepository implements SellerRepositoryInterface
{
    public function __construct(private readonly Model $model)
    {

    }

    public function createSeller(SellerDto $sellerDto): Result
    {
        $result = $this->model->create($sellerDto->toArray());
        if (!property_exists($result, 'id') && empty($result->id)) {
            return Result::fail(new InfrastructureError('Error creating seller'));
        }
        return Result::success($result);
    }
}
