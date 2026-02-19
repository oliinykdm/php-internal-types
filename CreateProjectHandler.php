<?php declare(strict_types=1);

namespace App;

use App\Types\ProjectDescription;
use App\Types\ProjectName;

final readonly class CreateProjectHandler
{
    public function __construct(
       // for example - private ProjectRepository $projectRepository
    ) {}

    public function handle(CreateProject $command): void
    {
        $newProject = new Project(
            new ProjectName($command->getName()->toString()),
            new ProjectDescription($command->getDescription()->toNullableString()),
        );
        // for example - $this->projectRepository->create($newProject);
    }

}
