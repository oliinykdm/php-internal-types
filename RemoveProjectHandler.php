<?php declare(strict_types=1);

namespace App;

use App\Exception\ProjectNotFoundException;

final readonly class RemoveProjectHandler
{
    public function __construct(
        private ProjectRepository $projectRepository
    ) {}

    public function handle(RemoveProject $command): void
    {
        $project = $this->projectRepository->get($command->getProjectId());

        if (!$project) {
            throw new ProjectNotFoundException('The project does not exist');
        }

        $this->projectRepository->delete($command->getProjectId());
    }

}
