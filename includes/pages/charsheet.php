<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ?page=login&state=login");
    exit;
}

$user_id = $_SESSION['user_id'];
$char_id = $_GET['charid'];

$stmt = $pdo->prepare("SELECT * FROM chars WHERE user_id = ? AND char_id = ?");
$stmt->execute([$user_id, $char_id]);
$char = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="charsheet">
    <div class="charinfo">
        <div class="double">
            <div class="single">
                <p>Name:</p>
                <p><?= $char['charname'] ?></p>
            </div>
            <div class="single">
                <p>Race:</p>
                <p><?= $char['charrace'] ?></p>
            </div>
        </div>
        <div class="double">
            <div class="single">
                <p>Class:</p>
                <p><?= $char['charclass'] ?></p>
            </div>
            <div class="single">
                <p>Level:</p>
                <p><?= $char['charlv'] ?></p>
            </div>
        </div>
    </div>

    <?php
    $stats = ['str_stat', 'dex_stat', 'con_stat', 'int_stat', 'wis_stat', 'cha_stat'];

    foreach ($stats as $stat) {
        echo "<p>{$char[$stat]}</p>";
    }
    ?>
</div>
