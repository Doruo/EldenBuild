DROP TABLE IF EXISTS build CASCADE;

CREATE TABLE Builds(
                       idBuild INT AUTO_INCREMENT,
                       nomBuild VARCHAR(50),
                       description VARCHAR(50),
                       dateCreation DATE,
                       visibilite VARCHAR(50),
                       equipLoad VARCHAR(50),
                       nomClasse VARCHAR(50),
                       login VARCHAR(50) NOT NULL,
                       PRIMARY KEY(idBuild),
                       FOREIGN KEY(equipLoad) REFERENCES EquipLoad(equipLoad),
                       FOREIGN KEY(nomClasse) REFERENCES Classes(nomClasse),
                       FOREIGN KEY(login) REFERENCES Users(login)
);