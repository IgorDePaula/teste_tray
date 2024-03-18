<?php

namespace Tray\Sells\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;
use Tray\Sells\Infrastructure\Error\NotFound;

class SellerRepository implements SellerRepositoryInterface
{
    public function __construct(
        private readonly Model $model
    )
    {

    }

    public function createSeller(SellerDto $sellerDto): Result
    {
        throw new \Exception('Not Implemented');
    }

    public function list(): Result
    {
        throw new \Exception('Not Implemented');
    }

    public function findSeller(int $id): Result
    {
        $seller = $this->model->find($id);
        if (!property_exists($seller, 'id') && empty($seller->id)) {
            return Result::fail(new NotFound('Not Found'));
        }
        return Result::success($seller);
    }
}
