<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Query\GetAllActivitiesQuery;
use App\Application\QueryHandler\GetAllActivitiesQueryHandler;
use App\Infrastructure\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllActivitiesController extends abstractController
{
    public function getActivities(): JsonResponse
    {
        $activityRepository = new ActivityRepository();
        $getAllActivitiesQueryHandler = new GetAllActivitiesQueryHandler($activityRepository);
        $getAllActivitiesQuery = new GetAllActivitiesQuery();
        $array = $getAllActivitiesQueryHandler->execute($getAllActivitiesQuery);
        return new JsonResponse($array);
    }
}
