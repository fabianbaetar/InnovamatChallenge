<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Query\GetAllActivitiesQuery;
use App\Domain\Repository\ActivityRepositoryInterface;

class GetAllActivitiesQueryHandler
{
    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function execute(GetAllActivitiesQuery $query): array
    {
        return $this->activityRepository->getAllActivities();
    }
}
