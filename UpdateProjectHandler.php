<?php declare(strict_types=1);

namespace App;

use App\CommonTypes\NullableRequiredString;
use App\CommonTypes\RequiredString;
use App\Exceptions\ProjectNotFoundException;
use App\Types\ProjectName;
use App\Types\ProjectDescription;

final readonly class UpdateProjectHandler
{
    public function __construct(
          private ProjectRepository $projectRepository
    ) {}

    public function handle(UpdateProject $command): void
    {
         $project = $this->projectRepository->get($command->getProjectId());

        if (!$project) {
            throw new ProjectNotFoundException('The project does not exist');
        }

        $updatedProject = new Project(
            $project->getProjectId(),
            $command->hasName() ? ProjectName::fromString($command->getName()->toString())
                : $project->getProjectName(),
            $command->hasDescription() ? ProjectDescription::fromNullableString($command->getDescription()->toNullableString())
                : $project->getProjectDescription(),
        );

         $this->projectRepository->update($updatedProject);
    }

}
