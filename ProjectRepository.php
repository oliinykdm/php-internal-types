<?php declare(strict_types=1);

namespace App;

use App\Types\ProjectId;

interface ProjectRepository
{
    public function get(ProjectId $projectId): ?Project;

    public function create(Project $project): void;

    public function update(Project $project): void;

    public function delete(ProjectId $projectId): void;
}
