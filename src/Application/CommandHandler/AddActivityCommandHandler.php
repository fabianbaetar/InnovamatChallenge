<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Command\AddActivityCommand;
use App\Domain\Repository\ActivityRepositoryInterface;

class AddActivityCommandHandler
{
    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function execute(AddActivityCommand $command): void
    {
        $this->activityRepository->addActivity(
            $command->getIdentifier(),
            $command->getName(),
            $command->getPosition(),
            $command->getTime(),
            $command->getDifficulty(),
            $command->getSolution()
        );
    }
}
