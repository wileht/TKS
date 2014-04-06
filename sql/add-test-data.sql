insert into Kayttaja
values(default, 'Tapsa','koppelo');

insert into Kayttaja
values(default,'Teppo','kappelo');

insert into Kayttajaryhma
values(default,'Yllapitajat');

insert into RyhmanKayttajat
values((select id from Kayttaja where nimi='Teppo'),(select id from Kayttajaryhma where nimi='Yllapitajat'));

insert into Keskustelualue
values(default,'Kissat');

insert into Keskustelualue
values(default,'Slovakia');

insert into Keskustelualue
values(default,'Mrt');

insert into Aloitusviesti
values(default,1,1,'raar','Mrkhavainto');

insert into Aloitusviesti
values(default,1,2,'roaar','Tm on viesti');

insert into Aloitusviesti
values(default,2,1,'raar!','zippadei');

insert into Vastine
values(default,1,1,1,'Tm on mrkhavainto Keravalta.');