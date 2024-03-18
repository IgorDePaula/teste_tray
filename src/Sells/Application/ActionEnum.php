<?php

namespace Tray\Sells\Application;

use Tray\Sells\Application\Action\CreateSellAction;

enum ActionEnum: string
{
    case CreateSellDto = CreateSellAction::class;
}
