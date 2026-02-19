<?php declare(strict_types=1);

namespace App;


use App\Types\ProjectDescription;
use App\Types\ProjectName;

final readonly class Project
{
    public function __construct(
        private ProjectName $projectName,
        private ProjectDescription $projectDescription,
    ) {}

    public function getProjectName(): ProjectName {
        return $this->projectName;
    }

    public function getProjectDescription(): ProjectDescription {
        return $this->projectDescription;
    }

}