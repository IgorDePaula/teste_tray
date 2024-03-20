<?php

namespace Tray\Sellers\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Domain\Director\DirectorInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Shared\SellerCollection;
use Tray\Sells\Infrastructure\Error\NotFound;

class SellerRepository implements SellerRepositoryInterface
{
    public function __construct(
        private readonly Model             $model,
        private readonly DirectorInterface $director
    )
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

    public function list(): Result
    {
        try {
            $all = $this->model::get();
            $collection = new SellerCollection();
            foreach ($all as $seller) {
                $collection->add($this->director->make($seller->toArray()));
            }
            return Result::success($collection);
        } catch (\Exception $exception) {
            return Result::fail(new InfrastructureError($exception->getMessage()));
        }
    }

    public function findSeller(int $id): Result
    {
        $seller = $this->model->find($id);
        if (empty($seller->id)) {
            return Result::fail(new NotFound('Seller not found'));
        }
        return Result::success($seller);
    }
}
