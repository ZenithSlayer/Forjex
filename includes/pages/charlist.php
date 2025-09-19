<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ?page=login&state=login");
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM chars WHERE user_id = ?");
$stmt->execute([$user_id]);
$characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="chatlist">
    <?php if (count($characters) === 0): ?>
        <div class="nochar">
            <p>You have no characters created yet.</p>
            <a href="?page=createchar">Create Character</a>
        </div>
    <?php else: ?>
        <p>Your Characters</p>
        <ul>
            <?php foreach ($characters as $char): ?>
                <li>
                    <strong><?= htmlspecialchars($char['charname']) ?></strong>
                    (Level <?= $char['charlv'] ?> <?= htmlspecialchars($char['charclass']) ?> - <?= htmlspecialchars($char['charrace']) ?>)<br>
                    Stats: STR <?= $char['str_stat'] ?>, DEX <?= $char['dex_stat'] ?>, CON <?= $char['con_stat'] ?>,
                    INT <?= $char['int_stat'] ?>, WIS <?= $char['wis_stat'] ?>, CHA <?= $char['cha_stat'] ?>
                </li><br>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>