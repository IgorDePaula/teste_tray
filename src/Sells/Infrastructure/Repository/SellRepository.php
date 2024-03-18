<?php

namespace Tray\Sells\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Application\AbstractDto;
use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;

class SellRepository implements SellRepositoryInterface
{
    public function __construct(private readonly Model $model)
    {

    }

    public function createSell(AbstractDto $dto): Result
    {
        $result = $this->model->create($dto->toArray());
        if (!property_exists($result, 'id') && empty($result->id)) {
            return Result::fail(new InfrastructureError());
        }
        return Result::success($result);
    }
}
