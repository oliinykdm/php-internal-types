<?php declare(strict_types=1);

namespace App\Packages\Common\Application\Types;

interface Type
{
    public static function isValid(mixed $value): bool;
}
