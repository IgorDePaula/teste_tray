<?php

namespace Tray\Core\Infrastructure\Http\Request;

use Tray\Core\Application\AbstractDto;

interface RequestInterface
{
    public function toDto(): AbstractDto;
}
