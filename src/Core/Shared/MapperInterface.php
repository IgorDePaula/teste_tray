<?php

namespace Tray\Core\Shared;

use Tray\Core\Application\AbstractDto;
use Tray\Core\Domain\AggregateInterface;

interface MapperInterface
{
    public function toDto($data, ?string $convertTo = null): AbstractDto;

    public function toPersistence(AbstractDto $data): array;

    public function toDomain(AbstractDto $dto): AggregateInterface;
}
