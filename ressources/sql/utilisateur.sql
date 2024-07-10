DROP TABLE IF EXISTS utilisateur CASCADE;

CREATE TABLE IF NOT EXISTS utilisateur
(`login` INT NOT NULL ,
 `nom` VARCHAR(32) NOT NULL ,
 `prenom` VARCHAR(32) NOT NULL ,
 `mdpHache` VARCHAR(256) NOT NULL,
 PRIMARY KEY (`login`)
)
    ENGINE = InnoDB
    CHARSET=utf8mb3
    COLLATE utf8mb3_general_ci;

-- ALTER TABLE `utilisateur` ADD `mdpHache` VARCHAR(256) NOT NULL AFTER `prenom`;

ALTER TABLE `utilisateur`
    ADD `estAdmin` BOOLEAN NOT NULL DEFAULT FALSE AFTER `mdpHache`;

ALTER TABLE `utilisateur`
    ADD `email` VARCHAR(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL AFTER `estAdmin`,
    ADD `emailAValider` VARCHAR(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL AFTER `email`,
    ADD `nonce` VARCHAR(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL AFTER `emailAValider`;