const fs = require('fs'); // Import the file system module

const data = {
    Name: 'jon',
    race: 'human',
    class: 'rogue',
    background: 'charlatan',
    level: 10,

    atribute: {
        str: 10,
        dex: 10,
        con: 10,
        int: 10,
        wis: 10,
        cha: 10,
    },

    stats: {
        str: ["Athletics"],
        dex: ["Acrobatics", "Sleight of Hand", "Stealth"],
        con: [],
        int: ["Arcana", "History", "Investigation", "Nature", "Religion"],
        wis: ["Animal Handling", "Insight", "Medicine", "Perception", "Survival"],
        cha: ["Deception", "Intimidation", "Performance", "Persuasion"]
    },

    proficience: {},
    expertize: {},

};

// Convert the JavaScript object to a JSON string
const jsonData = JSON.stringify(data, null, 2); // 'null' and '2' for pretty-printing

fs.writeFile('output.json', jsonData, 'utf8', (err) => {
    if (err) {
        console.error("Error writing file:", err);
    } else {
        console.log("JSON file created successfully!");
    }
});