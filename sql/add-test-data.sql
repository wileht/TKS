insert into Kayttaja
values(default, 'Tapsa','koppelo');

insert into Kayttaja
values(default,'Teppo','kappelo');

insert into Kayttajaryhma
values(default,'Ylläpitäjät');

insert into RyhmanKayttajat
values(default,(select id from Kayttaja where nimi='Teppo'),(select id from Kayttajaryhma where nimi='Ylläpitäjät'));

insert into Keskustelualue
values(default,'Kissat');

insert into Keskustelualue
values(default,'Slovakia');

insert into Keskustelualue
values(default,'Möröt');

insert into Aloitusviesti
values(default,1,1,'raar','Mörköhavainto','2013-02-11 23:58:00');

insert into Aloitusviesti
values(default,1,2,'roaar','Tämä on viesti','2014-01-12 00:32:34');

insert into Aloitusviesti
values(default,2,1,'raar!','zippadei','2003-10-10 14:12:42');

insert into Vastine
values(default,1,1,1,'Tämä on mörköhavainto Keravalta.','1763-11-11 15:30:01');

insert into Kayttajaryhma
values(default,'Hatut');

insert into RyhmanKeskustelualueet
values(default,(select id from Kayttajaryhma where nimi='Hatut'),(select id from Keskustelualue where nimi='Kissat'));