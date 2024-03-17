<?php

namespace Tray\Sellers\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Domain\Director\DirectorInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Application\Dto\SellerDto;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Shared\SellerCollection;

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
            $all = $this->model->newQuery();
            $sellers = [];
            foreach ($all as $seller) {
                $sellers[] = $this->director->make($seller->toArray());
            }
            return Result::success(SellerCollection::make($sellers));
        } catch (\Exception $exception) {
            return Result::fail(new InfrastructureError($exception->getMessage()));
        }
    }
}
