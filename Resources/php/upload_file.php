<?php
    ini_set('upload_max_filesize', '100M');
    ini_set('post_max_size', '100M');
    ini_set('max_file_uploads', '20');
    ini_set('memory_limit', '256M');
    set_time_limit(300);

    echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
    echo "post_max_size: " . ini_get('post_max_size') . "<br>";
    echo "memory_limit: " . ini_get('memory_limit') . "<br>";
    echo '<pre>'; print_r($_FILES); echo '</pre>';

    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';

    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_FILES['csv_file'])) {
        $filePath = "uploads/" . basename($_FILES['csv_file']['name']);
        move_uploaded_file($_FILES['csv_file']['tmp_name'], "../../output/output.csv");
        
        $new_file = file("../../output/output.csv");
        file_put_contents("../../" . $filePath, $new_file);

        session_start();
        $_SESSION['filename'] = $filePath;
        $_SESSION['head'] = true;
        header("location: ../../loading.php?file=import");
    }
    else {
        header("location: ../../import.php?error=No file found: " . $filePath);
    }