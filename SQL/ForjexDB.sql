DROP DATABASE ForjexDB;

CREATE DATABASE ForjexDB;

USE ForjexDB;

CREATE TABLE users (
    user_id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE chars (
    user_id BIGINT,
    char_id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    charname VARCHAR(50) NOT NULL,
    charclass VARCHAR(50) NOT NULL,
    charlv INT(2) NOT NULL,
    str_stat INT(2) DEFAULT 10 NOT NULL,
    dex_stat INT(2) DEFAULT 10 NOT NULL,
    con_stat INT(2) DEFAULT 10 NOT NULL,
    int_stat INT(2) DEFAULT 10 NOT NULL,
    wis_stat INT(2) DEFAULT 10 NOT NULL,
    cha_stat INT(2) DEFAULT 10 NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE classes (
    class VARCHAR(20),
    hitdie VARCHAR(3),
    savingthrows VARCHAR(50),
    armorprof TEXT,
    weaponprof TEXT,
    toolsprof TEXT
);

CREATE TABLE races (
  race VARCHAR(50) PRIMARY KEY,
  str_mod INT(1) DEFAULT 0,
  dex_mod INT(1) DEFAULT 0,
  con_mod INT(1) DEFAULT 0,
  int_mod INT(1) DEFAULT 0,
  wis_mod INT(1) DEFAULT 0,
  cha_mod INT(1) DEFAULT 0,
  speed INT(2),
  languages TEXT
);

INSERT INTO races VALUES
('dwarf',         0, 0, 2, 0, 0, 0, 25, 'common, dwarvish'),
('elf',           0, 2, 0, 0, 0, 0, 30, 'common, elvish'),
('halfling',      0, 2, 0, 0, 0, 0, 25, 'common, halfling'),
('human',         1, 1, 1, 1, 1, 1, 30, 'common, +1'),
('dragonborn',    2, 0, 0, 0, 0, 1, 30, 'common, draconic'),
('gnome',         0, 0, 0, 2, 0, 0, 25, 'common, gnomish'),
('half-elf',      0, 0, 0, 0, 0, 2, 30, 'common, elvish, +1'),
('half-orc',      2, 0, 1, 0, 0, 0, 30, 'common, orc'),
('tiefling',      0, 0, 0, 1, 0, 2, 30, 'common, infernal');

INSERT INTO classes VALUES 
('barbarian', 'd12', 'strength & constitution', 'light armor, medium armor, shields', 'simple weapons, martial weapons', NULL),
('bard', 'd8', 'dexterity & charisma', 'light armor', 'simple weapons, hand crossbows, longswords, rapiers, shortswords', 'choice'),
('cleric', 'd8', 'wisdom & charisma', 'light armor, medium armor, shields', 'all simple weapons', NULL),
('druid', 'd8', 'intelligence & wisdom', 'light armor, medium armor (nonmetal), shields (nonmetal)', 'clubs, daggers, darts, javelins, maces, quarterstaffs, scimitars, sickles, slings, spears', 'Herbalism kit'),
('fighter', 'd10', 'strength & constitution', 'light armor, medium armor, heavy armor, shields', 'simple weapons, martial weapons', NULL),
('monk', 'd8', 'strength & dexterity', NULL, 'simple weapons, shortswords', 'Three musical instruments of your choice'),
('paladin', 'd10', 'wisdom & charisma', 'light armor, medium armor, heavy armor, shields', 'simple weapons, martial weapons', NULL),
('ranger', 'd10', 'strength & dexterity', 'light armor, medium armor, shields', 'simple weapons, martial weapons', NULL),
('rogue', 'd8', 'dexterity & intelligence', 'light armor', 'simple weapons, hand crossbows, longswords, rapiers, shortswords', 'Thieves’ tools'),
('sorcerer', 'd6', 'constitution & charisma', NULL, 'daggers, darts, slings, quarterstaffs, light crossbows', NULL),
('warlock', 'd8', 'wisdom & charisma', 'light armor', 'simple weapons', NULL),
('wizard', 'd6', 'intelligence & wisdom', NULL, 'daggers, darts, slings, quarterstaffs, light crossbows', NULL);