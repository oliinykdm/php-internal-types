<?php declare(strict_types=1);

namespace App\CommonTypes;

use InvalidArgumentException;

class NonRequiredString implements Type
{
    private string $value;

    public function __construct(string $value)
    {
        if (!static::isValid($value)) {
            throw new InvalidArgumentException('Value must be a string and max 256 characters long.');
        }

        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public function toNonRequiredString(): NonRequiredString
    {
        return NonRequiredString::fromString($this->value);

    }

    public static function isValid(mixed $value): bool
    {
        return is_string($value) && (mb_strlen($value) < 256); // if it's actually a string, not big text
    }
}
