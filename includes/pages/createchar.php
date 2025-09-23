<?php
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
        <div>
            <p>Character Name</p>
            <input type="text" name="charname">
        </div>
        <div class="race">
            <p>Race</p>
            <select name="charrace" id="raceSelect">
                <option value="" hidden>Select your Race</option>
            </select>
        </div>
    </div>
    <div class="formsec">
        <div>
            <p>Class</p>
            <select name="charclass" id="classSelect">
                <option value="" hidden>Select your Class</option>
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
            <small class="mod-display" id="mod-stat1"></small>
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

    function getoptions(input) {
        const path = `../json/${input}.json`;

        const selectId = `${input}Select`;
        const selectElement = document.getElementById(selectId);

        if (!selectElement) {
            console.error(`Select element with id "${selectId}" not found.`);
            return;
        }

        selectElement.length = 1;

        fetch(path)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Failed to load JSON from ${path}`);
                }
                return response.json();
            })
            .then(data => {
                for (const key in data) {
                    const option = document.createElement("option");
                    option.value = key;
                    option.textContent = key.charAt(0).toUpperCase() + key.slice(1);
                    selectElement.appendChild(option);
                }
            })
            .catch(error => {
                console.error("Error loading data:", error);
            });
    }

    document.addEventListener("DOMContentLoaded", () => {
        getoptions("race");
        getoptions("class");
    });
</script>