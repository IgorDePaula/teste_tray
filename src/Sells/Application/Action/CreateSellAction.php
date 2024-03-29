<?php

namespace Tray\Sells\Application\Action;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Application\ActionInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sells\Application\Dto\SellDto;
use Tray\Sells\Application\Dto\SellerDto;
use Tray\Sells\Application\Dto\SellResponseDto;
use Tray\Sells\Infrastructure\Error\NotFound;

class CreateSellAction implements ActionInterface
{
    public function __construct(
        private readonly SellRepositoryInterface   $repository,
        private readonly SellerRepositoryInterface $sellerRepository,
        private readonly MapperInterface           $mapper
    )
    {

    }

    public function __invoke(?AbstractDto $dto): Result
    {
        $seller = $this->sellerRepository->findSeller($dto->seller);

        if ($seller->isFailure()) {
            return Result::fail(new NotFound($seller->getValue()->getMessage()));
        }
        $seller = $seller->getValue();
        $data['amount'] = $dto->amount;
        $data['commission'] = $seller->commission;
        $data['seller'] = $seller->id;
        $sellDto = $this->mapper->toDto($data, SellDto::class);
        $sell = $this->mapper->toDomain($sellDto);
        $commission = $sell->calculateCommission($this->mapper->toDto($seller->toArray(), SellerDto::class));
        $sellDto = $this->mapper->toDto([...$sellDto->toArray(), 'commission' => $commission], SellDto::class);
        $sell = $this->repository->createSell($sellDto);
        if ($sell->isFailure()) {
            return Result::fail(new InfrastructureError($sell->getValue()->getMessage()));
        }
        return Result::success($this->mapper->toDto($sell->getValue(), SellResponseDto::class));
    }
}
