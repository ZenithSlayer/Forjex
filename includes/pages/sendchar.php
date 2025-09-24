<?php
$user_id = $_SESSION['user_id'];
$charname = $_POST['charname'];
$charclass = $_POST['charclass'];
$charrace = $_POST['charrace'];
$charlv = $_POST['charlv'];
$str_stat = $_POST['STR'];
$dex_stat = $_POST['DEX'];
$con_stat = $_POST['CON'];
$int_stat = $_POST['INT'];
$wis_stat = $_POST['WIS'];
$cha_stat = $_POST['CHA'];

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

