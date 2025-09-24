<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ?page=login&state=login");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM chars WHERE user_id = ?");
$stmt->execute([$user_id]);
$characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="characters">
    <p class="title">Your Characters</p>
    <div class="charlist">

        <?php foreach ($characters as $char): ?>
            <a class="char" href="?page=charsheet&charid=<?= $char['char_id'] ?>">
                <p class="charname"><?= $char['charname'] ?></p>
                <p class="charinfo">
                    (Level <?= (int)$char['charlv'] ?>
                    <?= $char['charclass'] ?>
                    - <?= $char['charrace'] ?>)
                </p>
                <p class="charstats">
                    STR <?= $char['str_stat'] ?>,
                    DEX <?= $char['dex_stat'] ?>,
                    CON <?= $char['con_stat'] ?>,
                    INT <?= $char['int_stat'] ?>,
                    WIS <?= $char['wis_stat'] ?>,
                    CHA <?= $char['cha_stat'] ?>
                </p>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="createchar">
        <?php if (count($characters) === 0): ?>
            <p>You have no characters created yet.</p>
        <?php endif; ?>
        <a href="?page=createchar">Create Character</a>
    </div>
</div>