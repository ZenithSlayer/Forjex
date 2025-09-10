<form action="" class="createchar">
    <p>Character Name</p>
    <input type="text">
    <p>Race</p>
    <select name="race" id="race">
        <option value="" default hidden>Select your Race</option>
        <?php
        $Sql = "SELECT race FROM races";
        $Result = $pdo->query($Sql);

        if ($Result) {
            while ($row = $Result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row['race'] . '">' . $row['race'] . '</option>';
            }
        } else {
            echo '<option value="">Error loading races</option>';
        }
        ?>
    </select>

    <div class="classlv">
        <div>
            <p>Class</p>
            <select name="class" id="class">
                <option value="" default hidden>Select your class</option>
                <?php
                $Sql = "SELECT class FROM classes";
                $Result = $pdo->query($Sql);
        
                if ($Result) {
                    while ($row = $Result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['class'] . '">' . $row['class'] . '</option>';
                    }
                } else {
                    echo '<option value="">Error loading classes</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <p>Character Level</p>
            <input type="number" name="" id="" min="1" max="20" value="1">
        </div>
    </div>

    <div class="stats">
        <div>
            <p>Stat 1</p>
            <input type="number" name="" id="" min="1" max="20" value="10">
        </div>
        <div>
            <p>Stat 2</p>
            <input type="number" name="" id="" min="1" max="20" value="10">
        </div>
        <div>
            <p>Stat 3</p>
            <input type="number" name="" id="" min="1" max="20" value="10">
        </div>
        <div>
            <p>Stat 4</p>
            <input type="number" name="" id="" min="1" max="20" value="10">
        </div>
        <div>
            <p>Stat 5</p>
            <input type="number" name="" id="" min="1" max="20" value="10">
        </div>
        <div>
            <p>Stat 6</p>
            <input type="number" name="" id="" min="1" max="20" value="10">
        </div>
    </div>
</form>