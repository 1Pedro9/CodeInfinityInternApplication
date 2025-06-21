<?php 
    session_start();
    ini_set('memory_limit', '256M');
    if(!isset($_GET['index'])) {
        header("location: view.php?index=1");
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
    <h2>All the members</h2>

    <table>
        <thead>
            <tr>
                <?php
                    echo "
                        <th>Name</th>
                        <th>Surname</th>
                        <th>ID Number</th>
                        <th>Date of Birth</th>
                    ";
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                if (isset($_GET['index'])) {
                    $index = $_GET['index'];
                    require("Resources/php/manage_mango.php");
                    get_members((($index - 1)*100), ($index*100));
                }
            ?>
        </tbody>
    </table>


    <br><br>
    <div class="table-container">
        <?php
            if (isset($_GET['index']) && file_exists("output/output.csv")) {
                $index = (int) $_GET['index'];
                $size = get_member_count();
                $perPage = 100;

                $totalPages = ceil($size / $perPage);
                $last = $totalPages;

                if ($index > 1) {
                    $prev = $index - 1;
                    echo "<button><a href='view.php?index=$prev'>PREV</a></button>";
                    echo "<button><a href='view.php?index=1'>1</a></button>";
                }

                echo "<button><a href='view.php?index=$index'>$index</a></button>";

                if ($index < $last) {
                    echo "<button><a href='view.php?index=$last'>$last</a></button>";
                    $next = $index + 1;
                    echo "<button><a href='view.php?index=$next'>NEXT</a></button>";
                }
            }
            
        ?>
    </div>

</body>
</html>