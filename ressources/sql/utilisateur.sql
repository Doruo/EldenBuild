DROP TABLE IF EXISTS utilisateur CASCADE;

CREATE TABLE IF NOT EXISTS utilisateur
(`login` INT NOT NULL ,
 `nom` VARCHAR(32) NOT NULL ,
 `prenom` VARCHAR(32) NOT NULL ,
 `mdpHache` VARCHAR(256) NOT NULL,
 `email` VARCHAR(50) NOT NULL,
 `emailAVerifier` VARCHAR(50) NOT NULL,
 `nonce` VARCHAR(32) NOT NULL,
 `estAdmin` BOOLEAN NOT NULL,

 PRIMARY KEY (`login`)
)
    ENGINE = InnoDB
    CHARSET=utf8mb3
    COLLATE utf8mb3_general_ci;
