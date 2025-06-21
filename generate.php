<?php
    session_start();
    $_SESSION['filename'] = "output/output.csv";
    $_SESSION['head'] = false;
    ini_set('upload_max_filesize', '100M');
    ini_set('post_max_size', '100M');
    ini_set('max_file_uploads', '20');
    ini_set('memory_limit', '256M');
    set_time_limit(300);
    
    if(!isset($_GET['index'])) {
        header("location: generate.php?index=1");
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
        <a href="output/output.csv">Download CSV</a>
    </nav>
    <br><br><br>
    <h2>Generate CSV File</h2>
    <form method="get" action="loading.php?file">
        <input type="number" name="count" required placeholder="Number of records">
        <button type="submit" name="generate">Generate CSV</button>
    </form>

    <?php
        if (isset($_GET['amount'])) {
            echo "<h3>You have successfully created a file with {$_GET['amount']} entries</h3>";
        }
    ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Initials</th>
                <th>Age</th>
                <th>Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (isset($_GET['index'])) {
                    $_SESSION['index'] = $_GET['index'];
                    require("Resources/php/read_file.php");
                }
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
                    echo "<button><a href='generate.php?index=$prev'>PREV</a></button>";
                    echo "<button><a href='generate.php?index=1'>1</a></button>";
                }

                echo "<button><a href='generate.php?index=$index'>$index</a></button>";

                if ($index < $last) {
                    echo "<button><a href='generate.php?index=$last'>$last</a></button>";
                    $next = $index + 1;
                    echo "<button><a href='generate.php?index=$next'>NEXT</a></button>";
                }
            }
            
        ?>
    </div>

</body>
</html>
