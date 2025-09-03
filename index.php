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
    // Default page
    $page = 'home';

    // Check if a page is requested
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    // Whitelist pages for security
    $allowed_pages = ['home', 'about', 'contact'];

    if (!in_array($page, $allowed_pages)) {
        $page = 'home';
    }

    // Include the correct page content
    include "includes/pages/" . $page . ".php";
    ?>

    </main>

    <?php include "includes/footer.php" ?>
    <script src="javascript/script.js"></script>
</body>

</html>