<?php declare(strict_types=1);

namespace App;

use App\Types\ProjectId;

final readonly class RemoveProject
{
    public function __construct(
        private ProjectId $projectId,
    ) {}

    public function getProjectId(): ProjectId
    {
        return $this->projectId;
    }
}
