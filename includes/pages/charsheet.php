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

$raceData = json_decode(file_get_contents("./json/race.json"), true);
$classData = json_decode(file_get_contents("./json/class.json"), true);

$charRaceMods = $raceData[$char['charrace']]['mod'];
$charRaceSpeed = $raceData[$char['charrace']]['speed'];
$charHitDie = filter_var($classData[$char['charclass']]['hitdie'], FILTER_SANITIZE_NUMBER_INT);
$hperlv = ceil(($charHitDie + 1) / 2);

// Unified helper function for stats
function charStat($stat, $type = 'raw')
{
    global $char, $charRaceMods;
    $statsIndex = ['str_stat' => 0, 'dex_stat' => 1, 'con_stat' => 2, 'int_stat' => 3, 'wis_stat' => 4, 'cha_stat' => 5];
    $value = $char[$stat] + $charRaceMods[$statsIndex[$stat]];
    if ($type === 'mod') return floor(($value - 10) / 2);
    return $value;
}

// HP
function hp()
{
    global $charHitDie, $hperlv;
    $conMod = charStat('con_stat', 'mod');
    $level1 = $charHitDie + $conMod;
    $rest = ($hperlv + $conMod) * ($GLOBALS['char']['charlv'] - 1);
    return $level1 + $rest;
}

// AC
function ac()
{
    return 10 + charStat('con_stat', 'mod');
}

// Speed
function speed()
{
    global $charRaceSpeed;
    return $charRaceSpeed;
}
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

    <div class="statlist">
        <?php
        $statMap = [
            'str_stat' => 'STR',
            'dex_stat' => 'DEX',
            'con_stat' => 'CON',
            'int_stat' => 'INT',
            'wis_stat' => 'WIS',
            'cha_stat' => 'CHA'
        ];
        foreach ($statMap as $stat => $label): ?>
            <div class="stat">
                <p class="mod"><?= charStat($stat, 'mod') ?></p>
                <p class="statnumber"><?= charStat($stat) ?></p>
                <p class="statlabel"><?= $label ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="Achpsp">
        <div class="stat">
            <p><?= hp() ?></p>
        </div>
        <div class="stat">
            <p><?= ac() ?></p>
        </div>
        <div class="speed">
            <?= speed() ?>
        </div>
    </div>