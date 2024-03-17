<?php

namespace Tray\Core\Domain\Director;

use Tray\Core\Domain\Entity\EntityInterface;

interface DirectorInterface
{
    public function make(array $data): EntityInterface;
}
