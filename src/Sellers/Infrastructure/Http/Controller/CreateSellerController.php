<?php

namespace Tray\Sellers\Infrastructure\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Tray\Core\Application\ActionFactory;
use Tray\Core\Shared\Result;
use Tray\Sellers\Infrastructure\Error\InfrastructureError;
use Tray\Sellers\Infrastructure\Http\Request\CreateSellerRequest;

class CreateSellerController extends Controller
{
    public function __construct(private readonly ActionFactory $actionFactory)
    {

    }

    public function __invoke(CreateSellerRequest $request)
    {
        return $this->handleResponse(
            $this->actionFactory->makeAction($request->toDto())
        );
    }

    private function handleResponse(Result $result): JsonResponse
    {
        if ($result->isFailure()) {
            $class = get_class($result->getValue());
            return match ($class) {
                InfrastructureError::class => new JsonResponse(['success' => false, 'error' => $result->getValue()->getMessage()], JsonResponse::HTTP_BAD_REQUEST),
                default => new JsonResponse(['success' => false, 'error' => $result->getValue()->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR),
            };
        }
        return new JsonResponse(['success' => true, 'data' => $result->getValue()->toArray()], JsonResponse::HTTP_CREATED);
    }
}
