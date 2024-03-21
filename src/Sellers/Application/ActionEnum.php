<?php

namespace Tray\Sellers\Application;

use Tray\Sellers\Application\Action\{CreateSellerAction, ListSellersAction, ListSellFromSellerAction};


enum ActionEnum: string
{
    case SellerDto = CreateSellerAction::class;
    case ListSellerDto = ListSellersAction::class;
    case ListSellsSellerDto = ListSellFromSellerAction::class;
}
