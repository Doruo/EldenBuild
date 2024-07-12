
-- UTILISATEUR

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

-- BUILD

DROP TABLE IF EXISTS build CASCADE;

CREATE TABLE build(
                      idBuild INT AUTO_INCREMENT,
                      nomBuild VARCHAR(50),
                      description VARCHAR(50),
                      dateCreation DATE,
                      visibilite VARCHAR(50),
                      charge VARCHAR(50) NOT NULL,
                      nomClasse VARCHAR(50),
                      login VARCHAR(50) NOT NULL,
                      PRIMARY KEY(idBuild)
)
    ENGINE = InnoDB
    CHARSET=utf8mb3
    COLLATE utf8mb3_general_ci;

-- EVALUER