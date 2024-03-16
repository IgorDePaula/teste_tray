<?php

namespace Tray\Core\Application;


use Tray\Core\Shared\Result;

interface ActionInterface
{
    public function __invoke(?AbstractDto $dto): Result;
}
