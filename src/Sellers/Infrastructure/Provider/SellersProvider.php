<?php

namespace Tray\Sellers\Infrastructure\Provider;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Tray\Core\Application\ActionFactory;
use Tray\Core\Infrastructure\Repository\SellerRepositoryInterface;
use Tray\Sellers\Application\Action\CreateSellerAction;
use Tray\Sellers\Application\ActionEnum;
use Tray\Sellers\Infrastructure\Http\Controller\CreateSellerController;
use Tray\Sellers\Infrastructure\Repository\SellerRepository;

class SellersProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/routes.php');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->when(CreateSellerController::class)
            ->needs(ActionFactory::class)
            ->give(fn($app) => new ActionFactory(ActionEnum::class, $app));

        $this->app->when(CreateSellerAction::class)
            ->needs(SellerRepositoryInterface::class)
            ->give(fn($app) => $app->make(SellerRepository::class));

        $this->app->when(SellerRepository::class)
            ->needs(Model::class)
            ->give(Seller::class);
    }
}
