<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<nav class="main-nav">
    <div class="logo">
        <a href="?page=home">
            <img src="imgs/Forjex-logo.png" alt="Forjex Logo">
            <p>Forjex</p>
        </a>
    </div>

    <div class="links">
        <a href="?page=home" class="<?php echo ($page == 'home') ? 'active' : '' ?>">Home</a>
        <a href="?page=about" class="<?php echo ($page == 'about') ? 'active' : '' ?>">About</a>
        <a href="?page=contact" class="<?php echo ($page == 'contact') ? 'active' : '' ?>">Contact</a>
    <div>

    </div>
    <div class="speciallink">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="?page=createchar">Characters</a>
            <a href="?page=logout">Logout</a>
        <?php else: ?>
            <a href="?page=login&state=login">Login</a>
            <a href="?page=login&state=register">Register</a>
        <?php endif; ?>
    </div>
    </div>
</nav>