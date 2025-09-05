<?php
$state = $_GET['state'];

if ($state == 'login') {
    $otherstate = 'register';
} else {
    $otherstate = 'login';
}
?>

<div class="login">
    <div class="emailpass">
        <p>Email</p>
        <input type="email" name="" id="">
        <p>Password</p>
        <input type="text" name="" id="">
        <input type="button" value="<?= $state == 'login' ? 'Login' : 'Register' ?>">
        <a href="?page=login&state=<?= $otherstate ?>"> <p><?= $state == 'login' ? 'Dont have an account?' : 'Already have an account?' ?></p> </a>
    </div>
</div>