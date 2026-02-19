<?php declare(strict_types=1);

namespace App\CommonTypes;

interface Type
{
    public static function isValid(mixed $value): bool;
}
