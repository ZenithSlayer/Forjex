<?php
$page = $_GET['page']; 

if (file_exists("imgs/banner-$page.jpg")):
?>
    <header>
        <img src="imgs/banner-<?= htmlspecialchars($page) ?>.jpg" alt="">
    </header>
<?php
endif;
