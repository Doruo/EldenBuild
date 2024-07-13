CREATE TABLE Users(
                      login VARCHAR(50),
                      mdpHache VARCHAR(256) NOT NULL,
                      email VARCHAR(50) NOT NULL,
                      emailAVerifier VARCHAR(50) NOT NULL,
                      nonce VARCHAR(50) NOT NULL,
                      estAdmin BOOLEAN NOT NULL,
                      PRIMARY KEY(login)
);