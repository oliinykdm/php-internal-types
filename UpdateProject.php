<?php declare(strict_types=1);

namespace App;

use App\CommonTypes\NullableRequiredString;
use App\CommonTypes\PositiveInteger;
use App\CommonTypes\RequiredString;
use App\Types\ProjectId;

final readonly class UpdateProject
{
    public function __construct(
        private ProjectId $projectId,
        // here I use nullable generics because it can happen that PATCH request contains nothing or only one of them (just for example)
        private ?RequiredString $name,
        private ?NullableRequiredString $description,
    ) {}

    public function getProjectId(): ProjectId
    {
        return $this->projectId;
    }

    public function hasName(): bool
    {
        return !is_null($this->name);
    }

    public function getName(): ?RequiredString
    {
        return $this->name;
    }

    public function hasDescription(): bool
    {
        return !is_null($this->description);
    }

    public function getDescription(): NullableRequiredString
    {
        return $this->description;

    }

}
