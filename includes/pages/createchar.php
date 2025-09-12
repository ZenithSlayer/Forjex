<?php
$races = $pdo->query('SELECT race FROM races');
$classes = $pdo->query('SELECT class FROM classes');
?>

<div class="createchar">
    <div class="charinfo">
        <p>Character Name</p>
        <input type="text" name="charname">
        <div class="race">
            <p>Race</p>
            <select name="race" id="race">
                <option value="" hidden>Select your Race</option>
                <?php foreach ($races as $row): ?>
                    <option value="<?= $row['race'] ?>">
                        <?= $row['race'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="class">
            <div>
                <p>Class</p>
                <select name="class" id="class">
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
                <input type="number" name="" id="level" min="1" max="20" placeholder="1" oninput="limitToMax(this)">
            </div>
        </div>
    </div>
    <div class="charstats">
        <div>
            <p>Stat 1</p>
            <input type="number" name="" id="" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div>
            <p>Stat 2</p>
            <input type="number" name="" id="" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div>
            <p>Stat 3</p>
            <input type="number" name="" id="" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div>
            <p>Stat 4</p>
            <input type="number" name="" id="" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div>
            <p>Stat 5</p>
            <input type="number" name="" id="" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
        <div>
            <p>Stat 6</p>
            <input type="number" name="" id="" min="1" max="20" placeholder="10" oninput="limitToMax(this)">
        </div>
    </div>
</div>

<script>
function limitToMax(inputElement) {
  const maxValue = parseFloat(inputElement.getAttribute('max'));
  const currentValue = parseFloat(inputElement.value);

  if (currentValue > maxValue) {
    inputElement.value = maxValue;
  }
}
</script>