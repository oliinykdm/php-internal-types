<?php declare(strict_types=1);

namespace App;

use App\Types\ProjectDescription;
use App\Types\ProjectId;
use App\Types\ProjectName;

final readonly class CreateProjectHandler
{
    public function __construct(
       private ProjectRepository $projectRepository
    ) {}

    public function handle(CreateProject $command): void
    {
        $newProject = new Project(
            new ProjectId(rand(1, 32768)), // just to simplify the logic, I prefer to use UUID
            new ProjectName($command->getName()->toString()),
            new ProjectDescription($command->getDescription()->toNullableString()),
        );
        $this->projectRepository->create($newProject);
    }
}
