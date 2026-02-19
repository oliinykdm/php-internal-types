<?php declare(strict_types=1);

namespace App;

use App\Types\ProjectDescription;
use App\Types\ProjectId;
use App\Types\ProjectName;

final readonly class Project
{
    public function __construct(
        private ProjectId $projectId,
        private ProjectName $projectName,
        private ProjectDescription $projectDescription,
    ) {}

    public function getProjectId(): ProjectId {
        return $this->projectId;
    }

    public function getProjectName(): ProjectName {
        return $this->projectName;
    }

    public function getProjectDescription(): ProjectDescription {
        return $this->projectDescription;
    }

}