insert into Kayttaja
values(default, 'Tapsa','koppelo');

insert into Kayttaja
values(default,'Teppo','kappelo');

insert into Kayttajaryhma
values(default,'Yllapitajat');

insert into RyhmanKayttajat
values((select id from Kayttaja where nimi='Teppo'),(select id from Kayttajaryhma where nimi='Yllapitajat'));