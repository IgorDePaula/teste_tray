<?php

namespace Tray\Core\Shared;
// @codeCoverageIgnoreStart
trait TypeAssertionTrait
{
    protected function assertValidTypes($values): void
    {
        foreach ($values as $value) {
            $this->assertValidType($value);
        }
    }

    protected function assertValidType($value): void
    {
        if ($value instanceof $this->allowedType) {
            return;
        }
        throw new \InvalidArgumentException(
            sprintf(
                'The value %s is not of type %s',
                $value,
                $this->allowedType
            )
        );
    }
}
// @codeCoverageIgnoreEnd
