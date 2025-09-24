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

if (!$char) {
    header("Location: ?page=404");
    exit;
}

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

function profb(array $char): int
{
    $level = $char['charlv'];
    if ($level < 1) return 0;
    return intdiv($level - 1, 4) + 2;
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

    <div>
        <?php
        $savingThrows = [
            'Strength' => 'str_stat',
            'Dexterity' => 'dex_stat',
            'Constitution' => 'con_stat',
            'Intelligence' => 'int_stat',
            'Wisdom' => 'wis_stat',
            'Charisma' => 'cha_stat'
        ];

        $proficientStats = $classData[$char['charclass']]['saving throws'] ?? [];
        $proficientStats = array_map('strtolower', $proficientStats);
        ?>
        <ul>
            <?php foreach ($savingThrows as $name => $stat): ?>
                <?php
                $mod = (int) charStat($stat, 'mod');
                if (in_array(strtolower($name), $proficientStats, true)) {
                    $mod += (int) profb($char);
                }
                ?>
                <li>
                    <p><?= $name ?>:</p>
                    <p><?= $mod ?></p>
                    <?php if (in_array(strtolower($name), $proficientStats, true)) : ?>
                        <p>+</p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php
        $skills = [
            'Acrobatics' => 'dex_stat',
            'Animal Handling' => 'wis_stat',
            'Arcana' => 'int_stat',
            'Athletics' => 'str_stat',
            'Deception' => 'cha_stat',
            'History' => 'int_stat',
            'Insight' => 'wis_stat',
            'Intimidation' => 'cha_stat',
            'Investigation' => 'int_stat',
            'Medicine' => 'wis_stat',
            'Nature' => 'int_stat',
            'Perception' => 'wis_stat',
            'Performance' => 'cha_stat',
            'Persuasion' => 'cha_stat',
            'Religion' => 'int_stat',
            'Sleight of Hand' => 'dex_stat',
            'Stealth' => 'dex_stat',
            'Survival' => 'wis_stat'
        ];
        ?>
        <ul>
            <?php foreach ($skills as $skill => $stat): ?>
                <li>
                    <p><?= $skill ?>:</p>
                    <p><?= charStat($stat, 'mod') ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>