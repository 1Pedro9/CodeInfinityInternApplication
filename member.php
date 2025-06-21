<?php

    
    session_start();

    function initialize_session($item) {
        if(!isset($_SESSION[$item])) {
            $_SESSION[$item] = "";
        }
    }

    initialize_session("name");
    initialize_session("surname");
    initialize_session("id_num");
    initialize_session("dob");

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
    <link rel="stylesheet" href="Resources/css/member.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<body>
    <h1>Application for CodeInfinity (Pedro Basson)</h1>
    <form action="Resources/php/create_member.php" method="post">
        <label for="">Name</label>
        <input type="text" required name="name" value="<?php echo $_SESSION['name']; ?>">
        <label for="">Surname</label>
        <input type="text" required name="surname" value="<?php echo $_SESSION['surname']; ?>">
        <label for="">ID Number</label>
        <input type="number" required name="id_num" pattern="\d{13}" maxlength="13" value="<?php echo $_SESSION['id_num']; ?>">
        <label for="">Date of Birth</label>
        <input type="text" required name="dob" id="dob" value="<?php echo $_SESSION['dob']; ?>">
        <button type="button" name="cancel" onclick="window.location.href = 'index.php'">CANCEL</button>
        <button type="submit" name="post">POST</button>
    </form>

    <script>
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
        flatpickr("#dob", {
            dateFormat: "d/m/Y"  // This sets format to dd/mm/yyyy
        });

    </script>
</body>
</html>