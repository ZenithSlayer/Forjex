const fs = require('fs');

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

const jsonData = JSON.stringify(data, null, 2);

fs.writeFile('output.json', jsonData, 'utf8', (err) => {
    if (err) {
        console.error("Error writing file:", err);
    } else {
        console.log("JSON file created successfully!");
    }
});