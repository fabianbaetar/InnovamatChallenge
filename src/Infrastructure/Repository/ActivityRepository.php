<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\ActivityRepositoryInterface;
use SQLite3;

class ActivityRepository implements ActivityRepositoryInterface
{
    /** @var string */
    private const SQLITE_FILENAME = "../innovamat.sqlite";
    /** @var int */
    private const ITINERARY = 1;

    private SQLite3 $db;

    public function __construct()
    {
        $this->db = new SQLite3(self::SQLITE_FILENAME);
    }

    public function getAllActivities(): array
    {
        $sql = <<<SQL
            SELECT * FROM activity WHERE itinerary = 1 ORDER BY difficulty, position
        SQL;

        $query = $this->db->query($sql);

        $array = [];
        while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
            $newActivity = [
                $row['identifier'],
                $row['name'],
                $row['position'],
                $row['difficulty'],
                $row['time'],
                $row['solution']
            ];
            $array[] = $newActivity;
        }

        return $array;
    }

    public function addActivity(
        string $identifier,
        string $name,
        int $position,
        int $time,
        int $difficulty,
        string $solution
    ): bool {
        $sql = <<<SQL
            INSERT INTO activity (identifier, name, position, time, difficulty, solution, itinerary) 
            VALUES (:identifier, :name, :position, :time, :difficulty, :solution, :itinerary)
        SQL;

        $smt = $this->db->prepare($sql);
        $smt->bindValue(':identifier', $identifier, SQLITE3_TEXT);
        $smt->bindValue(':name', $name, SQLITE3_TEXT);
        $smt->bindValue(':position', $position, SQLITE3_INTEGER);
        $smt->bindValue(':time', $time, SQLITE3_INTEGER);
        $smt->bindValue(':difficulty', $difficulty, SQLITE3_INTEGER);
        $smt->bindValue(':solution', $solution, SQLITE3_TEXT);
        $smt->bindValue(':itinerary', self::ITINERARY, SQLITE3_INTEGER);

        return (bool) $smt->execute();
    }
}