<?php

$state = $_GET['state'] ?? 'login';
$otherstate = $state === 'login' ? 'register' : 'login';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($state === "register") {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        try {
            $check = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
            $check->execute([$email]);

            if ($check->fetch()) {
                $message = "Email already registered!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
                $stmt->execute([$email, $hashed]);
                $user_id = $pdo->lastInsertId();

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;

                header("Location: ?page=home");
                exit;
            }
        } catch (PDOException $e) {
            $message = "Registration failed: " . $e->getMessage();
        }
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: ?page=home");
            exit;
        } else {
            $message = "Invalid email or password!";
        }
    }
}
?>

<div class="login">
    <div class="error" style="opacity: <?= isset($message) ? 1 : 0 ?>;">
        <?php if ($message): ?>
            <p> <?= $message ?> </p>
        <?php endif; ?>
    </div>

    <form class="emailpass" method="post">
        <p>Email</p>
        <input type="email" name="email" placeholder="Input your email" required>
        <p>Password</p>
        <input type="password" name="password" placeholder="Input your password" required>
        <input class="send" type="submit" value="<?= $state === 'login' ? 'Login' : 'Register' ?>">
        <a href="?page=login&state=<?= $otherstate ?>">
            <p><?= $state === 'login' ? 'Dont have an account?' : 'Already have an account?' ?></p>
        </a>
    </form>
</div>