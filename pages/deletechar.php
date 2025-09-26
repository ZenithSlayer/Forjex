<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ?page=login&state=login");
    exit;
}

$user_id = $_SESSION['user_id'];
$char_id = $_POST['char_id'] ?? null;

if ($char_id) {
    $stmt = $pdo->prepare("DELETE FROM chars WHERE user_id = ? AND char_id = ?");
    $stmt->execute([$user_id, $char_id]);
}

header("Location: ?page=charlist");
exit;
