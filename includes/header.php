<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'default';
?>

<header>
    <img src="imgs/banner-<?php echo htmlspecialchars($page); ?>.jpg" alt="">
</header>
    