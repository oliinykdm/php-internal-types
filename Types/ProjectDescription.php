<?php declare(strict_types=1);

namespace App\Types;

use App\CommonTypes\NullableRequiredString;

final class ProjectDescription extends NullableRequiredString
{
    // so it is actually a nullable but required string otherwise an exception is thrown
}
