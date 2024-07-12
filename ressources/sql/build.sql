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