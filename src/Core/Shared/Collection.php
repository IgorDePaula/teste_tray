<?php

namespace Tray\Core\Shared;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

// @codeCoverageIgnoreStart
class Collection implements IteratorAggregate, Countable, ArrayAccess, ArrayableInterface
{

    use TypeAssertionTrait;

    protected string $allowedType = '';

    protected array $items = [];

    public function __construct(array $items = [])
    {
        if ('' !== $this->allowedType) {
            $this->assertValidTypes($items);
        }
        $this->items = $items;
    }

    public static function make(array $items = []): Collection
    {
        return new self($items);
    }

    public function first(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }
        if ($this->offsetExists(0)) {
            return $this->at(0);
        }
        return $this->at(array_key_first($this->items));
    }

    public function isEmpty(): bool
    {
        return $this->size() === 0;
    }

    public function size(): int
    {
        return count($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function at(int|string $index): mixed
    {
        if ($this->exists($index)) {
            return $this->items[$index];
        }
        return null;
    }

    public function exists(int|string $index): bool
    {
        return array_key_exists($index, $this->items);
    }

    public function count(): int
    {
        return $this->size();
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->at($offset) ?? null;
    }

    public function toArray(): array
    {
        return $this->all();
    }

    public function all(): array
    {
        return $this->items;
    }

    public function prepend(mixed $value): Collection
    {
        if ('' !== $this->allowedType) {
            $this->assertValidType($value);
        }
        array_unshift($this->items, $value);
        return $this;
    }

    public function onlyIndexes(mixed $indexes): Collection
    {
        $newItems = array_filter(
            array_map(
                fn($index) => $this->at($index), $indexes
            )
        );
        return new self($newItems);
    }

    public function last(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->at(array_key_last($this->items));
    }

    public function add(mixed $value): void
    {
        $this->offsetSet(null, $value);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }
}
// @codeCoverageIgnoreEnd
