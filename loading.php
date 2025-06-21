<?php
    ini_set('memory_limit', '256M');
    $max = 0;
    $link = "";
    $file = "";
    $count = 0;
    if (isset($_GET['generate'])) {
        $max = max(floor($_GET['count']/100), 1);
        $count = $_GET['count'];
        $link = "Resources/php/generate_file.php";
        $file = "Resources/php/check_uniqueness.php";
    } else {
        $max = max(floor(sizeof(file("output/output.csv"))/100), 1);
        $link = "Resources/php/load_sqlite.php";
        $file = $_GET['file'] . ".php";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Loading...</title>
    <link rel="stylesheet" href="Resources/css/loading.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="loader-wrapper">
        <div class="spinner"></div>
        <p>Loading...</p>
        <p><span id="container">0</span> packages out of <span id="max"><?php echo $max; ?></span> completed</p>
    </div>

    <script>
        let index = 1;
        let count = parseInt(document.querySelector("#max").textContent);
        const max = count;
        <?php
            if ($count != 0) {
                echo "count = $count;
                ";
            }
        ?>
        const link = "<?php echo $link; ?>";
        const nextPage = "<?php echo $file; ?>";

        function sendNextBatch() {
            if (index > max) {
                window.location.href = nextPage;
                return;
            }

            const postData = {
                index: index,
                max: count,
            };
            $.ajax({
                url: link,
                type: "POST",
                data: postData,
                success: function (response) {
                    document.querySelector("#container").textContent = index;
                    console.log(response);
                    index++;
                    sendNextBatch();
                },
                error: function (xhr, status, error) {
                    alert("There was an error. Please try again later.");
                    console.log(error);
                }
            });
        }

        // Start process after page loads
        $(document).ready(function () {
            sendNextBatch();
        });
    </script>

</body>
</html>
