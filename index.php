<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application for CodeInfinity</title>
    <link rel="stylesheet" href="Resources/css/home.css">
</head>
<body>
    
    <nav>
        <h1>Application for CodeInfinity (Pedro Basson)</h1>
    </nav>

    <main>
        <button><a href="view.php">See members</a></button>
        <button><a href="member.php">Become a member</a></button>
        <button><a href="generate.php">Generate a random table of people</a></button>
        <button><a href="import.php">Import your file to the database</a></button>
        <button><a href="database.php">See the database</a></button>
    </main>

    <?php
        if (isset($_GET['error'])) {
            echo "
                alert('{$_GET['error']}');
            ";
        } else if (isset($_GET['success'])) {
            echo "
                alert('{$_GET['success']}');
            ";
        }
    ?>

</body>
</html>