<?php
$user_id = $_SESSION['user_id'];
$charname = trim($_POST['charname']);
$charclass = $_POST['charclass'];
$charrace = $_POST['charrace'];
$charlv = (int)$_POST['charlv'];

$str_stat = (int)$_POST['stat1'];
$dex_stat = (int)$_POST['stat2'];
$con_stat = (int)$_POST['stat3'];
$int_stat = (int)$_POST['stat4'];
$wis_stat = (int)$_POST['stat5'];
$cha_stat = (int)$_POST['stat6'];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM chars WHERE charname = ? AND user_id = ?");
$stmt->execute([$charname, $user_id]);

if ($stmt->fetchColumn() > 0) {
    header("Location: ?page=createchar&error=1");
    exit;
}

$stmt = $pdo->prepare("
        INSERT INTO chars (
            user_id, charname, charclass, charrace, charlv,
            str_stat, dex_stat, con_stat, int_stat, wis_stat, cha_stat
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

$success = $stmt->execute([
    $user_id,
    $charname,
    $charclass,
    $charrace,
    $charlv,
    $str_stat,
    $dex_stat,
    $con_stat,
    $int_stat,
    $wis_stat,
    $cha_stat
]);

if ($success) {
    $char_id = $pdo->lastInsertId();
    header("Location: ?page=charsheet&charid=" . $char_id);
    exit;
}

