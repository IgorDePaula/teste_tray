<?php

namespace Tray\Core\Shared;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Domain\Entity\EntityInterface;

interface MapperInterface
{
    public function toDto($data, ?string $convertTo = null): AbstractDto;

    public function toPersistence(AbstractDto $data): array;

    public function toDomain(array $data): AbstractDto|EntityInterface;
}
