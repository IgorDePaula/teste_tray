<?php

namespace Tray\Sellers\Application;

use Tray\Sellers\Application\Action\CreateSellerAction;

enum ActionEnum: string
{
    case SellerDto = CreateSellerAction::class;
}
