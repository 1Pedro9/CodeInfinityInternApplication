<?php

function get_members($min, $max) {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $dbName = "CodeInfinityApply";
    $collection = "members";

    $options = [
        'skip' => $min,
        'limit' => $max - $min + 1,
        'sort' => ['_id' => 1] // optional: order by insertion
    ];

    $query = new MongoDB\Driver\Query([], $options);
    $cursor = $manager->executeQuery("$dbName.$collection", $query);

    foreach ($cursor as $doc) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($doc->name) . "</td>";
        echo "<td>" . htmlspecialchars($doc->surname) . "</td>";
        echo "<td>" . htmlspecialchars($doc->id_num) . "</td>";
        echo "<td>" . htmlspecialchars($doc->dob) . "</td>";
        echo "</tr>";
    }
}

function get_member_count() {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $dbName = "CodeInfinityApply";
    $collection = "members";

    $command = new MongoDB\Driver\Command([
        'count' => $collection
    ]);

    $result = $manager->executeCommand($dbName, $command)->toArray()[0];
    return $result->n ?? 0;
}
