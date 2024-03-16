<?php

namespace Tray\Core\Shared;

// @codeCoverageIgnoreStart
class Result
{
    public function __construct(private readonly bool $success, private readonly mixed $value = null)
    {

    }

    public static function success(mixed $value = null): self
    {
        return new self(true, $value);
    }

    public static function fail(mixed $value = null): self
    {
        return new self(false, $value);
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function isFailure(): bool
    {
        return !$this->success;
    }
}
// @codeCoverageIgnoreEnd
