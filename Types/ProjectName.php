<?php declare(strict_types=1);

namespace App\Types;

use App\CommonTypes\RequiredString;

final class ProjectName extends RequiredString
{
    // so it is actually a NOT nullable but required string otherwise an exception is thrown
}
