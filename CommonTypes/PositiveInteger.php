<?php declare(strict_types=1);

namespace App\CommonTypes;

use InvalidArgumentException;

class PositiveInteger implements Type
{
    private int $value;

    public function __construct(int $value)
    {
        if (!static::isValid($value)) {
            throw new InvalidArgumentException('Value must be positive integer');
        }

        $this->value = $value;
    }

    public function toInt(): int
    {
        return $this->value;
    }

    public static function fromInt(int $value): static
    {
        return new static($value);
    }

    public function toPositiveInteger(): PositiveInteger
    {
        return PositiveInteger::fromInt($this->value);

    }

    public static function isValid(mixed $value): bool
    {
        return is_int($value) && $value > 0;
    }
}
