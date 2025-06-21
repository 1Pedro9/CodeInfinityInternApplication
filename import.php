<?php 
    session_start();
    ini_set('upload_max_filesize', '100M');
    ini_set('post_max_size', '100M');
    ini_set('max_file_uploads', '20');
    ini_set('memory_limit', '256M');
    set_time_limit(300);

    if(!isset($_GET['index'])) {
        header("location: import.php?index=1");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application for CodeInfinity</title>
    <link rel="stylesheet" href="Resources/css/home.css">
    <link rel="stylesheet" href="Resources/css/generate.css">
</head>
<body>
    
    <nav>
        <h1>Application for CodeInfinity (Pedro Basson)</h1>
        <a href="index.php">Back Home</a>
    </nav>
    <br><br><br>
    <h2>Import CSV File</h2>
    <form method="post" action="Resources/php/upload_file.php" enctype="multipart/form-data">
        <input type="file" name="csv_file" required accept=".csv">
        <button type="submit">Import CSV</button>
    </form>

    <table>
        <thead>
            <tr>
                <?php
                    if(isset($_SESSION['head']) && $_SESSION['head'] === true){
                        require("Resources/php/read_file.php");
                    }
                    else {
                        echo "
                            <th>ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Initials</th>
                            <th>Age</th>
                            <th>Date of Birth</th>
                        ";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                // if(isset($_SESSION['filename'])){
                $_SESSION["head"] = false;
                $_SESSION['index'] = $_GET['index'];
                require("Resources/php/read_file.php");
                $_SESSION["head"] = true;
                // }
                
            ?>
        </tbody>
    </table>
    <br><br>
    <div class="table-container">
        <?php
            if (isset($_GET['index']) && file_exists("output/output.csv")) {
                $index = (int) $_GET['index'];
                $file = file("output/output.csv");
                $size = count($file);
                $perPage = 100;

                $totalPages = ceil($size / $perPage);
                $last = $totalPages;

                if ($index > 1) {
                    $prev = $index - 1;
                    echo "<button><a href='import.php?index=$prev'>PREV</a></button>";
                    echo "<button><a href='import.php?index=1'>1</a></button>";
                }

                echo "<button><a href='import.php?index=$index'>$index</a></button>";

                if ($index < $last) {
                    echo "<button><a href='import.php?index=$last'>$last</a></button>";
                    $next = $index + 1;
                    echo "<button><a href='import.php?index=$next'>NEXT</a></button>";
                }
            }
            
        ?>
    </div>

    <script>
        <?php
            if (isset($_GET['error'])) {
                echo "
                    alert('{$_GET['error']}');
                ";
            }
        ?>
    </script>
</body>
</html>