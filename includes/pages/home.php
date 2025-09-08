<div class="home">
    <div class="homelogo">
        <img src="imgs/Forjex-logo.png" alt="">
        <p>Welcome to Forjex</p>
        <p>This is an open-source web application built to create, store, and manage Dungeons & Dragons character sheets online. Designed with simplicity in mind, it helps players keep their characters organized without the hassle of juggling papers or scattered files.</p>
    </div>
    <div class="filler">
        <p>Key features:</p>
        <p>✦ Create and save unlimited character sheets</p>
        <p>✦ Automatic stat calculations and modifiers</p>
        <p>✦ Organized layout for quick reference during play</p>
        <p>✦ Cloud-based storage so you never lose your sheet</p>
        <p>✦ 100% free and open-source — community contributions welcome!</p>
    </div>


    <div class="homelogin" style="<?= (isset($_SESSION['user_id']) && $_SESSION['user_id']) ? 'display:none' : 'display:flex'; ?>">
        <a href="?page=login&state=login">Login</a>
        <p>Or</p>
        <a href="?page=login&state=register">Register</a>
    </div>
    <div class="homecharacters" style="<?= (isset($_SESSION['user_id']) && $_SESSION['user_id']) ? 'display:flex' : 'display:none'; ?>">
        <a href="?page=charcterview">View your Characters</a>
    </div>
</div>