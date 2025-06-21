<?php

ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('max_file_uploads', '20');
ini_set('memory_limit', '256M');
set_time_limit(300);

$names = ["Sean", "Sasha", "John", "Alice", "Michael", "Emily", "Robert", "Linda", "James", "Barbara", "William", "Elizabeth", "David", "Jennifer", "Richard", "Maria", "Joseph", "Susan", "Thomas", "Margaret"];
$surnames = ["Pompeii", "Hall", "Smith", "Brown", "Johnson", "Williams", "Jones", "Miller", "Davis", "Garcia", "Rodriguez", "Martinez", "Hernandez", "Lopez", "Gonzalez", "Wilson", "Anderson", "Thomas", "Taylor", "Moore"];

function generate($i) {
    global $names;
    global $surnames;
    $name = $names[rand(0, max: 19)];
    $surname = $surnames[rand(0, max: 19)];
    $initials = substr($name, 0, 1);
    $age = rand(18, 99);

    $day = rand(1, 364);
    $date = strtotime("-$age year -$day days");
    $dob = date("d/m/Y", $date);

    $text = "$i,$name,$surname,$initials,$age,$dob\n";
    return $text;
}

if (isset($_POST['max'])) {

    
    $count = $_POST['max'];
    $index = $_POST['index'];
    if ($index == 1) {
        $string = "id,name,surname,initials,age,date of birth\n";
    }
    
    $array = array();

    for ($i= (($index - 1)*100) + 1; $i <= min($index * 100, $count); $i++) { 
        
        $text = generate($i);
        $string .= $text;
    }

    for ($i=0; $i < sizeof($array); $i++) { 
        $string .= $array[$i];
    }
    
    if ($index == 1) {
        file_put_contents("../../output/output.csv", $string);
    } else {
        // Append to file
        file_put_contents("../../output/output.csv", $string, FILE_APPEND);
    }
    
    echo "Success";
}