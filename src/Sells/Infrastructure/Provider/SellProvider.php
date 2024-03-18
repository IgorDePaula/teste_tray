<?php

namespace Tray\Sells\Infrastructure\Provider;

use App\Models\Sell;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Tray\Core\Application\ActionFactory;
use Tray\Core\Infrastructure\Repository\SellRepositoryInterface;
use Tray\Core\Shared\MapperInterface;
use Tray\Sells\Application\Action\CreateSellAction;
use Tray\Sells\Application\ActionEnum;
use Tray\Sells\Infrastructure\Http\Controller\CreateSellController;
use Tray\Sells\Infrastructure\Repository\SellRepository;
use Tray\Sells\Shared\SellMapper;

class SellProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Http/routes.php');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->when(CreateSellController::class)
            ->needs(ActionFactory::class)
            ->give(fn($app) => new ActionFactory(ActionEnum::class, $app));

        $this->app->when(CreateSellAction::class)
            ->needs(SellRepositoryInterface::class)
            ->give(fn($app) => $app->make(SellRepository::class));

        $this->app->when(SellRepository::class)
            ->needs(Model::class)
            ->give(Sell::class);

        $this->app->when(SellRepository::class)
            ->needs(MapperInterface::class)
            ->give(fn() => new SellMapper());

    }
}
