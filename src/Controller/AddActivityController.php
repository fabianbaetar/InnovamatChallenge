<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\AddActivityCommand;
use App\Application\CommandHandler\AddActivityCommandHandler;
use App\Infrastructure\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AddActivityController extends abstractController
{
    public function getActivities(Request $request): JsonResponse
    {
        $params = \json_decode($request->getContent(), true);

        if ($params['difficulty'] < 0 || $params['difficulty'] > 10) {
            return new JsonResponse("Valor de dificultad invalido");
        }

        $activityRepository = new ActivityRepository();
        $getAllActivitiesQuery = new AddActivityCommand(
            $params['identifier'],
            $params['name'],
            $params['position'],
            $params['time'],
            $params['difficulty'],
            $params['solution']
        );
        $getAllActivitiesQueryHandler = new AddActivityCommandHandler($activityRepository);
        $getAllActivitiesQueryHandler->execute($getAllActivitiesQuery);

        return new JsonResponse();
    }
}
