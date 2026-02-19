<?php declare(strict_types=1);

namespace App\Types;

use App\CommonTypes\PositiveInteger;

final class ProjectId extends PositiveInteger
{
    // just a positive integer to simplify the solution without needing to deal with UUID
}
