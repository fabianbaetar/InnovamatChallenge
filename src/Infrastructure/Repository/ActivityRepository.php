<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\ActivityRepositoryInterface;
use SQLite3;

class ActivityRepository implements ActivityRepositoryInterface
{
    /** @var string */
    private const SQLITE_FILENAME = "../innovamat.sqlite";

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
}