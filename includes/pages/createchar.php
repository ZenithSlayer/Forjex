<?php
$races = $pdo->query('SELECT race FROM races');
$classes = $pdo->query('SELECT class FROM classes');
if (!isset($_SESSION['user_id'])) {
    header("Location: ?page=login&state=login");
}
?>

<?php if (isset($_GET['error'])): ?>
    <?php
    $error = (int)$_GET['error'];
    switch ($error) {
        case 1:
            $message = "You already have a character with that name.";
            break;
        case 2:
            $message = "You dont have any characters.";
            break;
        default:
            $message = "An unknown error occurred.";
    }
    ?>
    <p style="color: red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form class="createchar" method="POST" action="?page=sendchar">
    <div class="formsec">
        <div class="name">
            <p>Character Name</p>
            <input type="text" name="charname">
        </div>
        <div class="race">
            <p>Race</p>
            <select name="charrace">
                <option value="" hidden>Select your Race</option>
                <?php foreach ($races as $row): ?>
                    <option value="<?= $row['race'] ?>">
                        <?= $row['race'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="formsec">
        <div>
            <p>Class</p>
            <select name="charclass">
                <option value="" hidden>Select your class</option>
                <?php foreach ($classes as $row): ?>
                    <option value="<?= $row['class'] ?>">
                        <?= $row['class'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <p>Character Level</p>
            <input type="number" name="charlv" min="1" max="20" placeholder="1" oninput="limitToMax(this)">
        </div>
    </div>
    <div class="charstats">
        <div class="stat">
            <p>STR</p>
            <input type="number" name="stat1" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div class="stat">
            <p>DEX</p>
            <input type="number" name="stat2" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div class="stat">
            <p>CON</p>
            <input type="number" name="stat3" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div class="stat">
            <p>INT</p>
            <input type="number" name="stat4" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div class="stat">
            <p>WIS</p>
            <input type="number" name="stat5" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div class="stat">
            <p>CHA</p>
            <input type="number" name="stat6" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
    </div>
    <button type="submit">Create character</button>
</form>

<script>
    function limitToMax(inputElement) {
        const maxValue = parseFloat(inputElement.getAttribute('max'));
        const currentValue = parseFloat(inputElement.value);

        if (currentValue > maxValue) {
            inputElement.value = maxValue;
        }
    }
</script>