<?php
session_start();
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "CodeInfinityApply";
$collection = "members";

if (isset($_POST['post'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $id_num = $_POST['id_num'];
    $dob = $_POST['dob'];

    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['id_num'] = $id_num;
    $_SESSION['dob'] = $dob;

    if (strlen($id_num) != 13) {
        $_SESSION['id_num'] = "";
        header("Location: ../../member.php?error=Your ID number must be 13 digits.");
        exit;
    }

    if (!preg_match("/^[a-zA-Z\s'-]+$/", $name)) {
        header("Location: ../../member.php?error=Name contains invalid characters.");
        exit;
    }
    
    if (!preg_match("/^[a-zA-Z\s'-]+$/", $surname)) {
        header("Location: ../../member.php?error=Surname contains invalid characters.");
        exit;
    }

    $dateObj = DateTime::createFromFormat('d/m/Y', $dob);

    if (!$dateObj || $dateObj->format('d/m/Y') !== $dob) {
        header("Location: ../../member.php?error=Invalid date format. Use dd/mm/yyyy.");
        exit;
    }

    $dobYYMMDD = $dateObj->format('ymd');
    $idPrefix = substr($id_num, 0, 6);

    if ($dobYYMMDD !== $idPrefix) {
        echo "DOB derived from input: $dobYYMMDD<br>";
        echo "ID Number prefix: $idPrefix<br>";
        exit;
    }

    // Check for duplicates in DB
    $filter = ['id_num' => $id_num];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery("$dbName.$collection", $query);
    $results = $cursor->toArray();

    if (count($results) > 0) {
        header("Location: ../../member.php?error=This ID number is already in the database.");
        exit;
    }

    // Insert into MongoDB
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert([
        'name' => $name,
        'surname' => $surname,
        'id_num' => $id_num,
        'dob' => $dob
    ]);
    $manager->executeBulkWrite("$dbName.$collection", $bulk);

    header("Location: ../../index.php?success=Application submitted successfully.");
    exit;
    
}
else if (isset($_POST['cancel'])) {
    $_SESSION['name'] = "";
    $_SESSION['surname'] = "";
    $_SESSION['id_num'] = "";
    $_SESSION['dob'] = "";
}