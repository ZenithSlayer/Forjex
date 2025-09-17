<!DOCTYPE html>
<html lang="en">

<?php include "includes/db.php"
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <title>Forjex</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "includes/nav.php" ?>
    <?php include "includes/header.php" ?>

    <main>
        
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        $allowed_pages = ['home', 'about', 'contact', 'login' , 'error', 'createchar' , 'logout', 'view_character'];

        if (!in_array($page, $allowed_pages)) {
            $page = 'error';
        }

        include "includes/pages/" . $page . ".php";
            ?>
    </main>

    <?php include "includes/footer.php" ?>
</body>

</html>