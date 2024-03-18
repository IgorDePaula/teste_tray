<?php

namespace Tray\Sells\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Tray\Core\Application\AbstractDto;
use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;

class SellRepository implements SellRepositoryInterface
{
    public function __construct(
        private readonly Model           $model,
        private readonly MapperInterface $mapper
    )
    {

    }

    public function createSell(AbstractDto $dto): Result
    {
        $result = $this->model->create($this->mapper->toPersistence($dto));
        if (!property_exists($result, 'id') && empty($result->id)) {
            return Result::fail(new InfrastructureError());
        }
        return Result::success($result);
    }
}
