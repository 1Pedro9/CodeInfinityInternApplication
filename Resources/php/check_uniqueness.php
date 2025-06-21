<?php

ini_set('memory_limit', '512M'); // More safety for large files

$path = "../../output/output.csv";
$file = file($path);
$header = array_shift($file); // Save header

$seen = [];
$fixed = [];

$names = ["Sean", "Sasha", "John", "Alice", "Michael", "Emily", "Robert", "Linda", "James", "Barbara", "William", "Elizabeth", "David", "Jennifer", "Richard", "Maria", "Joseph", "Susan", "Thomas", "Margaret"];
$surnames = ["Pompeii", "Hall", "Smith", "Brown", "Johnson", "Williams", "Jones", "Miller", "Davis", "Garcia", "Rodriguez", "Martinez", "Hernandez", "Lopez", "Gonzalez", "Wilson", "Anderson", "Thomas", "Taylor", "Moore"];

function generate_line($i) {
    global $names, $surnames;
    $name = $names[rand(0, count($names) - 1)];
    $surname = $surnames[rand(0, count($surnames) - 1)];
    $initials = substr($name, 0, 1);
    $age = rand(18, 99);
    $day = rand(1, 364);
    $date = strtotime("-$age years -$day days");
    $dob = date("d/m/Y", $date);
    return "$i,$name,$surname,$initials,$age,$dob\n";
}

for ($i = 0; $i < count($file); $i++) {
    $line = $file[$i];

    while (isset($seen[trim($line)])) {
        $line = generate_line($i + 1);
    }

    $seen[trim($line)] = true;
    $fixed[] = $line;
}

file_put_contents($path, $header . implode("", $fixed));

header("Location: ../../loading.php?file=generate");
exit;
