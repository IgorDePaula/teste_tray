<?php

namespace Tray\Core\Domain\Builder;

use Tray\Core\Domain\Entity\EntityInterface;

interface BuilderInterface
{
    public function build(): EntityInterface;
}
