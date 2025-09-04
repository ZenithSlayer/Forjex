<?php
$page = $_GET['page'];
if (is_null($page)) {
    $page = 'home';}
?>

<header>
    <img src="imgs/banner-<?php echo($page); ?>.jpg" alt="">
</header>
    