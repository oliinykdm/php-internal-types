<?php declare(strict_types=1);

namespace App;

use App\CommonTypes\NullableRequiredString;
use App\CommonTypes\RequiredString;

final readonly class CreateProject
{
    public function __construct(
        // here I use generic types because it can be used later in command so they have to be generics
        private RequiredString $name,
        private NullableRequiredString $description,
    ) {}

    public function getName(): RequiredString
    {
        return $this->name;
    }

    public function getDescription(): NullableRequiredString
    {
        return $this->description;

    }

}
