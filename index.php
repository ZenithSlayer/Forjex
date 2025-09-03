<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forjex</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "includes/nav.php" ?>
    <?php include "includes/header.php" ?>

    <main>
        <?php

        $page = $_GET['page'] ?? 'home';
        if (file_exists($page)) {
            include $page;
        } else {
            include "pages/error.php";
        }
        ?>

    </main>

    <?php include "includes/footer.php" ?>
    <script src="javascript/script.js"></script>
</body>

</html>