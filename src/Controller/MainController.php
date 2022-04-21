<?php

namespace App\Controller;

use App\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/activities")
     */
    public function getActivities(Request $request): JsonResponse
    {
        if ($request->getMethod() == "GET") {
            $db = new \SQLite3("../innovamat.sqlite");
            $query = $db->query('SELECT * FROM activity WHERE itinerary = 1 order by difficulty, position');

            $array = array();

            while ($row = $query->fetchArray(SQLITE3_NUM)) {

                $newActivity = [
                    $row[0],
                    $row[1],
                    $row[2],
                    $row[3],
                    $row[4],
                    $row[5]
                ];
                array_push($array, $newActivity);
            }

            return new JsonResponse($array);
        } else {
            $params = \json_decode($request->getContent(), true);
            // var_dump($params);

            if ($params['difficulty'] < 0 || $params['difficulty'] > 10) {
                return new JsonResponse("Valor de dificultad invalido");
            }

            $db = new \SQLite3("../innovamat.sqlite");
            $query = $db->exec(
                sprintf(
                    "INSERT INTO activity (identifier, name, position, time, difficulty, solution, itinerary) VALUES (\"%s\", \"%s\", %s, %s, %s, \"%s\", 1)",
                    $params['identifier'],
                    $params['name'],
                    $params['position'],
                    $params['time'],
                    $params['difficulty'],
                    $params['solution']
                )
            );

            new JsonResponse();
        }

        return new JsonResponse();
    }

    /**
     * @Route("/registerActivity", methods={"POST"})
     */
    public function RegisterActivity(Request $request): JsonResponse
    {
        $params = \json_decode($request->getContent(), true);

        $db = new \SQLite3("../innovamat.sqlite");

        $query = $db->query(sprintf("SELECT * FROM activity where identifier = \"%s\"", $params['identifier']));

        $row = $query->fetchArray(SQLITE3_NUM);

        $activity = new Activity($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);

        $answers = explode('_', $params['answers']);
        $aAnswers = explode('_', $activity->getSolution());

        if (count($answers) !== count($aAnswers)) {
            return new JsonResponse(sprintf(
                "Las respuestas dadas '%s' no concuerdan con la solución '%s'",
                $params['answers'],
                $activity->getSolution()
            ));
        }
        /*
         * To obtain the score we first calculate each answer's value
         * and then add it to the final score for every correct one
         */
        $score = 0;
        $isCorrect = 100 / count($aAnswers);
        foreach ($answers as $index => $answer) {
            $solution = $aAnswers[$index];
            if ($solution === $answer) {
                $score += $isCorrect;
            }
        }

        $query = $db->exec(
            sprintf(
                "INSERT INTO answer (student_id, activity_identifier, score, time, solution, created_at)
                        VALUES (1, \"%s\", \"%s\", \"%s\", \"%s\", \"%s\")",
                $params['identifier'],
                $score,
                $params['time'],
                $params['answers'],
                date("Y-m-d H:i:s")
            )
        );

        return new JsonResponse();
    }

    /**
     * @Route("/nextActivity", methods={"GET"})
     */
    public function NextActivity(Request $request): JsonResponse
    {
        $db = new \SQLite3("../innovamat.sqlite");

        $query = $db->query(
            sprintf("select
                                   *,
                                   (SELECT score from answer an where an.activity_identifier = a.identifier order by an.score DESC limit 1) as score
                            from activity a
                            where a.itinerary = 1
                            order by a.difficulty, a.position"
            )
        );

        $next = false;

        while ($row = $query->fetchArray()) {
            if ($row['score'] && $row['score'] > 50) {
                $next = true;
                continue;
            } else {
                $next = $row['identifier'];
                break;
            }

        }

        return new JsonResponse([$next ? $next : "Itinerario completado"]);
    }
}