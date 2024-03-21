<?php

namespace Tray\Sellers\Infrastructure\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Tray\Core\Application\ActionFactory;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Infrastructure\Http\Request\ListSellSellerRequest;
use Tray\Sells\Infrastructure\Error\NotFound;

class ListSellSellerController extends Controller
{
    public function __construct(private readonly ActionFactory $actionFactory)
    {
    }

    public function __invoke(ListSellSellerRequest $request): JsonResponse
    {
        return $this->handleResult(
            $this->actionFactory->makeAction($request->toDto())
        );
    }

    protected function handleResult(Result $result): JsonResponse
    {
        if ($result->isFailure()) {
            $class = get_class($result->getValue());
            return match ($class) {
                NotFound::class => new JsonResponse($result->getValue()->getMessage(), JsonResponse::HTTP_NOT_FOUND),
                InfrastructureError::class => new JsonResponse($result->getValue()->getMessage(), JsonResponse::HTTP_SERVICE_UNAVAILABLE),
                default => new JsonResponse($result->getValue()->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR),
            };
        }
        return new JsonResponse([$result->getValue()->toArray()], JsonResponse::HTTP_OK);
    }
}
