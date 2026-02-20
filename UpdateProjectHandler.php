<?php declare(strict_types=1);

namespace App;

use App\CommonTypes\NullableRequiredString;
use App\CommonTypes\RequiredString;
use LogicException;

final readonly class UpdateProjectHandler
{
    public function __construct(
          private ProjectRepository $projectRepository
    ) {}

    public function handle(UpdateProject $command): void
    {
         $project = $this->projectRepository->get($command->getProjectId());

        if (!$project) {
            throw new LogicException('The project does not exist');
        }

        $updatedProject = new Project(
            $project->getProjectId(),
            $command->hasName() ? RequiredString::fromString($command->getName()->toString())
                : $project->getProjectName(),
            $command->hasDescription() ? NullableRequiredString::fromNullableString(
                !$command->getDescription()->isNull()
                    ? $command->getDescription()->toNullableString()
                    : ''
            )
                : $project->getProjectDescription(),
        );

         $this->projectRepository->update($updatedProject);
    }

}
