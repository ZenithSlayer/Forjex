<nav class="main-nav">
    <div class="logo">
        <a href="?page=home">
            <img src="imgs/Forjex-logo.png" alt="Forjex Logo">
            <p>Forjex</p>
        </a>
    </div>

    <div class="links">
        <a href="?page=home">Home</a>
        <a href="?page=about">About</a>
        <a href="?page=contact">Contact</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="loginnav">
                <a href="?page=logout">Logout</a>
            </div>
        <?php else: ?>
            <div class="loginnav">
                <a href="?page=login&state=login">Login</a>
                <a href="?page=login&state=register">Register</a>
            </div>
        <?php endif; ?>
    </div>
</nav>