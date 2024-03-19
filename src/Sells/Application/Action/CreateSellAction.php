<?php

namespace Tray\Sells\Application\Action;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Application\ActionInterface;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Core\Shared\Result;
use Tray\Sells\Application\Dto\SellDto;
use Tray\Sells\Domain\Aggregate\Sell;
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
            return Result::fail(new NotFound('Seller not found'));
        }
        $seller = $seller->getValue();
        $data['amount'] = $dto->amount;
        $data['commission'] = $seller->commission;
        $sellDto = $this->mapper->toDto($data, SellDto::class);

        $sell = new Sell($sellDto);
        $commission = $sell->calculateCommission($seller);
        $sellDto = $this->mapper->toDto([...$sellDto->toArray(), 'commission' => $commission], SellDto::class);
        return $this->repository->createSell($sellDto);
    }
}
