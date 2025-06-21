<?php

$filename = "output/output.csv";
if(isset($_SESSION['filename'])) {
    // $filename = $_SESSION['filename'];
}

if (isset($_SESSION['head']) && $_SESSION['head'] === true) {
    if (file_exists($filename)) {
        $file = file($filename);
        if (sizeof($file) > 0) {
            $data = explode(",", $file[0]);
            for ($i=0; $i < sizeof($data); $i++) { 
                echo "<th>{$data[$i]}</th>";
            }
        }
    } else {
        echo "No file found at $filename";
    }
}
else {
    function print_row($data) {
        echo "<tr>";
        for ($i=0; $i < sizeof($data); $i++) { 
            echo "<td>{$data[$i]}</td>";
        }
        echo "</tr>";
    }

    if (file_exists($filename)) {
        $file = file($filename);
        $first = true;
        $index = 1;
        if (isset($_SESSION['index'])) {
            $index = $_SESSION['index'];
        }
        for ($i= ($index-1)*100; $i < min(sizeof($file), ($index*100)); $i++) { 
            $line = $file[$i];
            if ($first && $index == 1) {
                $first = false;
                continue;
            }
            $data = explode(",", $line);
            print_row($data);
        }
    } else {
        echo "No file found at $filename";
    }
}