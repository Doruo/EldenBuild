CREATE TABLE IF NOT EXISTS Users (
                      login VARCHAR(50),
                      mdpHache VARCHAR(256) NOT NULL,
                      email VARCHAR(50) NOT NULL,
                      emailAVerifier VARCHAR(50) NOT NULL,
                      nonce VARCHAR(50) NOT NULL,
                      PRIMARY KEY(login)
);

CREATE TABLE IF NOT EXISTS Classes(
                        nomClasse VARCHAR(50),
                        PRIMARY KEY(nomClasse)
);

CREATE TABLE IF NOT EXISTS EquipLoad(
                          equipLoad VARCHAR(50),
                          PRIMARY KEY(equipLoad)
);

CREATE TABLE IF NOT EXISTS Armor(
                      idArmor VARCHAR(50),
                      PRIMARY KEY(idArmor)
);

CREATE TABLE IF NOT EXISTS Ammos(
                      idAmmo VARCHAR(50),
                      PRIMARY KEY(idAmmo)
);

CREATE TABLE IF NOT EXISTS Talismans(
                          idTalisman VARCHAR(50),
                          PRIMARY KEY(idTalisman)
);

CREATE TABLE IF NOT EXISTS MagicSpells(
                            idMagicSpell VARCHAR(50),
                            PRIMARY KEY(idMagicSpell)
);

CREATE TABLE IF NOT EXISTS Weapons(
                        idWeapon VARCHAR(50),
                        PRIMARY KEY(idWeapon)
);

CREATE TABLE IF NOT EXISTS Tools(
                      idTool VARCHAR(50),
                      PRIMARY KEY(idTool)
);

CREATE TABLE IF NOT EXISTS AshesOfWar(
                           idAshOfWar VARCHAR(50),
                           PRIMARY KEY(idAshOfWar)
);

CREATE TABLE IF NOT EXISTS Suivis(
                       login VARCHAR(50),
                       login_1 VARCHAR(50),
                       dateSuivi DATE,
                       PRIMARY KEY(login, login_1),
                       FOREIGN KEY(login) REFERENCES Users(login),
                       FOREIGN KEY(login_1) REFERENCES Users(login)
);

CREATE TABLE IF NOT EXISTS Builds(
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

CREATE TABLE IF NOT EXISTS Incantations(
                             idMagicSpell VARCHAR(50),
                             PRIMARY KEY(idMagicSpell),
                             FOREIGN KEY(idMagicSpell) REFERENCES MagicSpells(idMagicSpell)
);

CREATE TABLE IF NOT EXISTS Items(
                      idTool VARCHAR(50),
                      PRIMARY KEY(idTool),
                      FOREIGN KEY(idTool) REFERENCES Tools(idTool)
);

CREATE TABLE IF NOT EXISTS Sorceries(
                          idMagicSpell VARCHAR(50),
                          PRIMARY KEY(idMagicSpell),
                          FOREIGN KEY(idMagicSpell) REFERENCES MagicSpells(idMagicSpell)
);

CREATE TABLE IF NOT EXISTS Spirits(
                        idTool VARCHAR(50),
                        PRIMARY KEY(idTool),
                        FOREIGN KEY(idTool) REFERENCES Tools(idTool)
);

CREATE TABLE IF NOT EXISTS ArmorBuild(
                           idBuild INT,
                           idArmor VARCHAR(50),
                           categorie VARCHAR(50),
                           PRIMARY KEY(idBuild, idArmor, categorie),
                           FOREIGN KEY(idBuild) REFERENCES Builds(idBuild),
                           FOREIGN KEY(idArmor) REFERENCES Armor(idArmor)
);

CREATE TABLE IF NOT EXISTS WeaponBuild(
                            idWeapon VARCHAR(50),
                            idBuild INT,
                            categorie VARCHAR(50),
                            PRIMARY KEY(idWeapon, idBuild, categorie),
                            FOREIGN KEY(idWeapon) REFERENCES Weapons(idWeapon),
                            FOREIGN KEY(idBuild) REFERENCES Builds(idBuild)
);

CREATE TABLE IF NOT EXISTS evaluerBuild(
                             login VARCHAR(50),
                             idBuild INT,
                             note VARCHAR(50),
                             PRIMARY KEY(login, idBuild),
                             FOREIGN KEY(login) REFERENCES Users(login),
                             FOREIGN KEY(idBuild) REFERENCES Builds(idBuild)
);

CREATE TABLE IF NOT EXISTS contientTalisman(
                                 idBuild INT,
                                 idTalisman VARCHAR(50),
                                 PRIMARY KEY(idBuild, idTalisman),
                                 FOREIGN KEY(idBuild) REFERENCES Builds(idBuild),
                                 FOREIGN KEY(idTalisman) REFERENCES Talismans(idTalisman)
);

CREATE TABLE IF NOT EXISTS contientMagicSpell(
                                   idBuild INT,
                                   idMagicSpell VARCHAR(50),
                                   PRIMARY KEY(idBuild, idMagicSpell),
                                   FOREIGN KEY(idBuild) REFERENCES Builds(idBuild),
                                   FOREIGN KEY(idMagicSpell) REFERENCES MagicSpells(idMagicSpell)
);

CREATE TABLE IF NOT EXISTS contientTool(
                             idBuild INT,
                             idTool VARCHAR(50),
                             PRIMARY KEY(idBuild, idTool),
                             FOREIGN KEY(idBuild) REFERENCES Builds(idBuild),
                             FOREIGN KEY(idTool) REFERENCES Tools(idTool)
);

CREATE TABLE IF NOT EXISTS contientAmmo(
                             idBuild INT,
                             idAmmo VARCHAR(50),
                             PRIMARY KEY(idBuild, idAmmo),
                             FOREIGN KEY(idBuild) REFERENCES Builds(idBuild),
                             FOREIGN KEY(idAmmo) REFERENCES Ammos(idAmmo)
);

CREATE TABLE IF NOT EXISTS contientAshOfWar(
                                 idBuild INT,
                                 idAshOfWar VARCHAR(50),
                                 PRIMARY KEY(idBuild, idAshOfWar),
                                 FOREIGN KEY(idBuild) REFERENCES Builds(idBuild),
                                 FOREIGN KEY(idAshOfWar) REFERENCES AshesOfWar(idAshOfWar)
);