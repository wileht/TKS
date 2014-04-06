CREATE TABLE Keskustelualue (
id SERIAL PRIMARY KEY,
Nimi VARCHAR(50)
);

CREATE TABLE Kayttaja (
id SERIAL PRIMARY KEY,
Nimi VARCHAR(30),
Salasana VARCHAR(20)
);

CREATE TABLE Kayttajaryhma (
id SERIAL PRIMARY KEY,
Nimi VARCHAR(30)
);

CREATE TABLE RyhmanKayttajat (
Kayttaja INTEGER REFERENCES Kayttaja(id) ON DELETE CASCADE,
Kayttajaryhma INTEGER REFERENCES Kayttajaryhma(id) ON DELETE CASCADE
);

CREATE TABLE Aloitusviesti (
id SERIAL PRIMARY KEY,
Kirjoittaja INTEGER REFERENCES Kayttaja(id) ON DELETE SET NULL,
Keskustelualue INTEGER REFERENCES Keskustelualue(id) ON DELETE CASCADE,
Sisalto VARCHAR(65535),
Otsikko VARCHAR(30)
);

CREATE TABLE Vastine (
id SERIAL PRIMARY KEY,
Kirjoittaja INTEGER REFERENCES Kayttaja(id) ON DELETE SET NULL,
Keskustelualue INTEGER REFERENCES Keskustelualue(id) ON DELETE CASCADE,
Aloitusviesti INTEGER REFERENCES Aloitusviesti(id),
Sisalto VARCHAR(65535)
);


CREATE TABLE ViestinLukeneet (
id SERIAL PRIMARY KEY,
Viesti REFERENCES Aloitusviesti(id) ON DELETE CASCADE,
Kayttaja REFERENCES Kayttaja(id) ON DELETE CASCADE
);