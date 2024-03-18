<?php

namespace Tray\Sellers\Application;

use Tray\Sellers\Application\Action\{CreateSellerAction, ListSellersAction};

enum ActionEnum: string
{
    case SellerDto = CreateSellerAction::class;
    case ListSellerDto = ListSellersAction::class;
}
