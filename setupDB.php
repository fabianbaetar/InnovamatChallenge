<?php

$file = 'innovamat.sqlite';
@unlink($file);

$db = new \SQLite3($file);

$db->exec('CREATE TABLE IF NOT EXISTS itinerary (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name VARCHAR NOT NULL
)');

for ($i=1;$i<=3;$i++) {
    $insert = $db->prepare("INSERT INTO itinerary (name) VALUES('Itinerary $i')");
    $insert->execute();
}

$db->exec('CREATE TABLE IF NOT EXISTS activity (
    identifier VARCHAR PRIMARY KEY NOT NULL,
    name VARCHAR NOT NULL,
    position INTEGER NOT NULL,
    difficulty INTEGER NOT NULL,
    time INTEGER NOT NULL,
    solution VARCHAR NOT NULL,
    itinerary INTEGER NOT NULL
)');

$activities = [
    ['A1', 1, 1, 120, '1_0_2', 1],
    ['A2', 2, 1, 60, '-2_40_56', 1],
    ['A3', 3, 1, 120, '1_0', 1],
    ['A4', 4, 1, 180, '1_0_2_-5_9', 1],
    ['A5', 5, 2, 120, '1_0_2', 1],
    ['A6', 6, 2, 120, '1_0_2', 1],
    ['A7', 7, 3, 120, "1_-1_'Si'_34_-6", 1],
    ['A8', 8, 3, 120, '1_2', 1],
    ['A9', 9, 4, 120, '1_0_2', 1],
    ['A10', 10, 5, 120, '1_0_2', 1],
    ['A11', 11, 6, 120, '1_0_2', 1],
    ['A12', 12, 7, 120, '1_0_2', 1],
    ['A13', 13, 8, 120, '1_0_2', 1],
    ['A14', 14, 9, 120, '1_0_2', 1],
    ['A15', 15, 10, 120, '1_0_2', 1],
    ['A16', 1, 1, 120, '1_0_2', 2],
];

foreach ($activities as $activity) {
    $insert = $db->prepare("INSERT INTO activity (identifier, name, position, time, difficulty, solution, itinerary) VALUES (:identifier, :name, :position, :time, :difficulty, :solution, :itinerary)");

    $name = "Activity " . $activity[0];
    $insert->bindParam(':identifier', $activity[0]);
    $insert->bindParam(':name', $name);
    $insert->bindParam(':position', $activity[1]);
    $insert->bindParam(':time', $activity[3]);
    $insert->bindParam(':difficulty', $activity[2]);
    $insert->bindParam(':solution', $activity[4]);
    $insert->bindParam(':itinerary', $activity[5]);

    $insert->execute();
}

$db->exec('CREATE TABLE IF NOT EXISTS student (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name VARCHAR NOT NULL
)');

$insert = $db->prepare("INSERT INTO student (name) VALUES('Carlos')");
$insert->execute();

$db->exec('CREATE TABLE IF NOT EXISTS answer (
    student_id INTEGER NOT NULL,
    activity_identifier VARCHAR NOT NULL,
    score INTEGER NOT NULL,
    time INTEGER NOT NULL,
    solution VARCHAR NOT NULL,
    created_at DATETIME NOT NULL
)');

echo "SQLite created\n";
