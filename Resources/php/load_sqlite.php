<?php

    ini_set('memory_limit', '256M');
    $filename = "../../output/output.csv";

    if (file_exists($filename) && isset($_POST['index'])) {
        $index = $_POST['index'];
        $max = $_POST['max'];
        require("manage_sqlite.php");
        if ($index == 1) {
            remove_file_sql();
        }
        init();

        $file = file($filename);
        for ($i=($index - 1) * 100; $i < min($index * 100, sizeof($file)); $i++) { 
            $line = $file[$i];
            $array = explode(",", $line);
            if (sizeof($array) == 6) {
                insert_entry($array[0], $array[1], $array[2], $array[3], $array[4], $array[5]);
            } else {
                echo "error";
                return;
            }
        }
        echo "Successfully loaded your lines";
    } else {
        echo "error";
    }
