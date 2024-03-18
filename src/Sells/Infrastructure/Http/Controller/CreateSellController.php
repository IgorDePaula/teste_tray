<?php

namespace Tray\Sells\Infrastructure\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Tray\Core\Application\ActionFactory;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sells\Infrastructure\Http\Request\CreateSellRequest;

class CreateSellController extends Controller
{
    public function __construct(private readonly ActionFactory $actionFactory)
    {

    }

    public function __invoke(CreateSellRequest $request): JsonResponse
    {
        return $this->handleResult(
            $this->actionFactory->makeAction($request->toDto())
        );
    }

    private function handleResult(Result $result): JsonResponse
    {
        if ($result->isFailure()) {
            $class = get_class($result->getValue());
            return match ($class) {
                default => new JsonResponse(['success' => false, 'data' => $result->getValue()->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR),
                InfrastructureError::class => new JsonResponse(['success' => false, 'data' => $result->getValue()->getMessage()], JsonResponse::HTTP_BAD_REQUEST),
            };
        }
        return new JsonResponse(['success' => false, 'data' => $result->getValue()->toArray()], JsonResponse::HTTP_CREATED);
    }
}
