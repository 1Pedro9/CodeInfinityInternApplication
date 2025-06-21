<?php
    
    function init() {
        $filepath = "../database";
        $db = new PDO("sqlite:$filepath/csv_database.sqlite");

        $db->exec("CREATE TABLE IF NOT EXISTS csv_import (
            id INTEGER,
            name TEXT,
            surname TEXT,
            initials TEXT,
            age INTEGER,
            date_of_birth TEXT
        )");

    }
    
    function print_rows($min, $max) {
        $db = new PDO("sqlite:Resources/database/csv_database.sqlite");
    
        $limit = $max - $min + 1;
        $offset = $min;
        // echo $min . "<br>";
        // echo $max;
    
        $stmt = $db->query("SELECT * FROM csv_import LIMIT $limit OFFSET $offset");
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
    }

    function size() {
        $db = new PDO("sqlite:Resources/database/csv_database.sqlite");
    
        $stmt = $db->query("SELECT COUNT(*) as count FROM csv_import");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['count'];
    }
    
    

    function remove_file_sql() {
        $filepath = "../database/csv_database.sqlite";
        file_put_contents($filepath, "");
    }

    function insert_entry($id, $name, $surname, $initials, $age, $dob) {
        $filepath = "../database";
        $db = new PDO("sqlite:$filepath/csv_database.sqlite");
        if (true) {
            if (!is_numeric($id) || !is_numeric($age)) {
                // echo "Skipping this entry: $id, $name, $surname, $initials, $age, $dob";
                return false;
            }
            
            /*str_replace("\'", "\\\'", $name);
            str_replace("\'", "\\\'", $surname);
            str_replace("\'", "\\\'", $initials);

            str_replace("\"", "\\\"", $name);
            str_replace("\"", "\\\"", $surname);
            str_replace("\"", "\\\"", $initials);*/

            str_replace("\\", "\\\\", $name);
            str_replace("\\", "\\\\", $surname);
            str_replace("\\", "\\\\", $initials);
        }
        

        // echo "Inserting $id, $name, $surname, $initials, $age, $dob into csv_database.sqlite <br>";
        $db->exec("
            INSERT INTO csv_import 
            VALUES($id, '$name', '$surname', '$initials', $age, '$dob');
        ");
        return true;
    }
