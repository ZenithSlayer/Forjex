<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ?page=login&state=login");
}
?>

<div class="createchar">
    <?php if (isset($_GET['error'])): ?>
        <?php
        $error = (int)$_GET['error'];
        switch ($error) {
            case 1:
                $message = "You already have a character with that name.";
                break;
            case 2:
                $message = "You don't have any characters.";
                break;
            default:
                $message = "An unknown error occurred.";
        }
        ?>
        <p class="error"><?= $message ?></p>
    <?php endif; ?>
    <form method="POST" action="?page=sendchar">
        <div class="formsec">
            <div>
                <p>Character Name</p>
                <input required type="text" name="charname">
            </div>
            <div class="race">
                <p>Race</p>
                <select required name="charrace" id="raceSelect">
                    <option value="" hidden>Select your Race</option>
                </select>
            </div>
        </div>

        <div class="formsec">
            <div>
                <p>Class</p>
                <select required name="charclass" id="classSelect">
                    <option value="" hidden>Select your Class</option>
                </select>
            </div>
            <div>
                <p>Character Level</p>
                <input required type="number" name="charlv" min="1" max="20" placeholder="1" oninput="limitnum(this)">
            </div>
        </div>

        <div class="charstats">
            <?php
            $stats = ['STR', 'DEX', 'CON', 'INT', 'WIS', 'CHA'];
            foreach ($stats as $stat) { ?>
                <div class="stat">
                    <p><?= $stat ?></p>
                    <input required type="number" name="<?= $stat ?>" id="<?= $stat ?>" min="1" max="20" value="10" oninput="limitnum(this)">
                </div>
            <?php } ?>
        </div>

        <button type="submit">Create character</button>
    </form>
    <div class="mods">
        <div class="racestats">
        </div>
        <div class="classstats">
        </div>
    </div>
</div>


<script>
    function limitnum(input) {
        const maxValue = parseInt(input.getAttribute('max'));
        const minValue = parseInt(input.getAttribute('min'));
        let currentValue = parseInt(input.value);

        if (currentValue > maxValue) input.value = maxValue;
        if (currentValue < minValue) input.value = minValue;
    }

    function getoptions(input) {
        const select = document.getElementById(`${input}Select`);
        select.length = 1;

        fetch(`./json/${input}.json`)
            .then(r => r.ok ? r.json() : Promise.reject(r.statusText))
            .then(data => {
                Object.keys(data).forEach(key => {
                    const option = new Option(key, key);
                    select.appendChild(option);
                });
            })
            .catch(console.error);
    }

    getoptions("race");
    getoptions("class");

    const stats = ['STR', 'DEX', 'CON', 'INT', 'WIS', 'CHA'];

    function setupSelection(selectId, jsonPath, containerClass, type = 'mod') {
        const select = document.getElementById(selectId);
        const container = document.querySelector(containerClass);

        container.innerHTML = '';
        if (type === 'mod') {
            stats.forEach(stat => {
                const pair = document.createElement('div');
                pair.classList.add('stats');

                const name = document.createElement('p');
                name.textContent = stat;

                const val = document.createElement('p');
                val.textContent = '—';
                val.classList.add('stat-val');

                pair.appendChild(name);
                pair.appendChild(val);
                container.appendChild(pair);
            });
        } else if (type === 'class') {
            fetch(jsonPath)
                .then(r => r.ok ? r.json() : Promise.reject(r.statusText))
                .then(data => {
                    const firstClass = Object.values(data)[0];
                    Object.keys(firstClass).forEach(prop => {
                        const row = document.createElement('div');
                        row.classList.add('class');

                        const name = document.createElement('p');
                        name.textContent = prop;
                        name.classList.add('name');

                        const valContainer = document.createElement('div');
                        valContainer.classList.add('items');

                        const item = document.createElement('p');
                        item.textContent = '—';
                        valContainer.appendChild(item);

                        row.appendChild(name);
                        row.appendChild(valContainer);
                        container.appendChild(row);
                    });
                })
                .catch(console.error);
        }


        select.addEventListener('change', async (e) => {
            const key = e.target.value;
            try {
                const data = await fetch(jsonPath).then(r => r.ok ? r.json() : Promise.reject(r.statusText));

                if (type === 'mod') {
                    const mods = data[key]?.mod || [];
                    container.querySelectorAll('.stats').forEach((pair, i) => {
                        const val = pair.querySelector('p:nth-child(2)');
                        const bonus = mods[i] || 0;
                        val.textContent = bonus !== 0 ? (bonus > 0 ? `+${bonus}` : `${bonus}`) : '—';
                        val.classList.remove('pos', 'neg');
                        if (bonus > 0) val.classList.add('pos');
                    });
                } else if (type === 'class') {
                    const cls = data[key];
                    container.querySelectorAll('.class').forEach(row => {
                        const prop = row.querySelector('p:first-child').textContent;
                        const valContainer = row.querySelector('.items');
                        const value = cls[prop];

                        valContainer.innerHTML = '';

                        if (!value) {
                            const placeholder = document.createElement('p');
                            placeholder.textContent = '—';
                            valContainer.appendChild(placeholder);
                        } else if (Array.isArray(value)) {
                            value.forEach(item => {
                                const p = document.createElement('p');
                                p.textContent = item;
                                valContainer.appendChild(p);
                            });
                        } else if (typeof value === 'string' && value.includes(',')) {
                            value.split(',').map(s => s.trim()).forEach(item => {
                                const p = document.createElement('p');
                                p.textContent = item;
                                valContainer.appendChild(p);
                            });
                        } else {
                            const p = document.createElement('p');
                            p.textContent = value;
                            valContainer.appendChild(p);
                        }
                    });
                }


            } catch (err) {
                console.error(err);
            }
        });
    }

    setupSelection('raceSelect', './json/race.json', '.racestats', 'mod');
    setupSelection('classSelect', './json/class.json', '.classstats', 'class');


    function addScrollSelect(selectId) {
        const select = document.getElementById(selectId);
        select.addEventListener("wheel", e => {
            e.preventDefault();
            const options = Array.from(select.options);
            const currentIndex = select.selectedIndex;

            if (e.deltaY < 0) {
                select.selectedIndex = (currentIndex - 1 + options.length) % options.length;
            } else {
                select.selectedIndex = (currentIndex + 1) % options.length;
            }

            select.dispatchEvent(new Event("change"));
        });
    }

    addScrollSelect("raceSelect");
    addScrollSelect("classSelect");
</script>