<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}


if (file_exists("imgs/banner-$page.jpg")):
?>
    <header>
        <img src="imgs/banner-<?= htmlspecialchars($page) ?>.jpg" alt="">
    </header>
<?php
endif;
