<?php

namespace Tray\Core\Application;


use ArrayAccess;
use InvalidArgumentException;

// @codeCoverageIgnoreStart
abstract class AbstractDto implements ArrayAccess
{
    abstract static public function fromArray(array $data): static;

    abstract public function toArray(): array;

    public function offsetSet($offset, mixed $value): void
    {
        throw new InvalidArgumentException('Cannot set or update properties');
    }

    public function offsetExists($offset): bool
    {
        return isset($this->{$offset});
    }

    public function offsetUnset($offset): void
    {
        throw new InvalidArgumentException('Cannot unset properties');
    }

    public function offsetGet($offset): mixed
    {
        return $this->{$offset};
    }
}
// @codeCoverageIgnoreEnd
