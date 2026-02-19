<?php declare(strict_types=1);

namespace App\CommonTypes;

use InvalidArgumentException;

class NullableRequiredString implements Type
{
    private ?string $value;

    public function __construct(?string $value)
    {
        if (!static::isValid($value)) {
            throw new InvalidArgumentException('Value must be a non-empty string (max 256 characters long) or null.');
        }

        $this->value = $value;
    }

    public function toNullableString(): ?string
    {
        return $this->value;
    }

    public static function fromNullableString(?string $value): static
    {
        return new static($value);
    }

    public function toNullableRequiredString(): NullableRequiredString
    {
        return NullableRequiredString::fromNullableString($this->value);

    }

    public function createNull(): static
    {
        return new static(null);
    }

    public function isNull(): bool
    {
        return is_null($this->value);
    }

    public static function isValid(mixed $value): bool
    {
        return is_null($value) || RequiredString::isValid($value);
    }
}
