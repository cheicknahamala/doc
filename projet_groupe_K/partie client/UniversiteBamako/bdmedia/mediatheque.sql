/*contraintes SQL et non SQL */

----Contraintes SQL
drop table client;
drop table village;
drop table sejour;

drop table demande cascade constraints;
drop table adherant cascade constraints;
drop table bibliothecaire;
drop table documents;
drop table emprunt;
drop table retour;
drop table reservation;
drop table livre;
drop table dvd;
drop table cd;
drop table revue;
		
drop sequence seq_adherant;
drop sequence seq_bibliothecaire;
drop sequence seq_documents;
drop sequence seq_emprunt;
drop sequence seq_retour;
drop sequence seq_reservation;

create sequence seq_adherant start with 1;
create sequence seq_bibliothecaire start with 1;
create sequence seq_documents start with 20;
create sequence seq_emprunt start with 1;
create sequence seq_retour start with 10;
create sequence seq_reservation start with 1;


--0 ordres tapés pour programmeur:
create table demande(
             nom varchar2(10) not null,
             prenom varchar2(10) not null,
             email varchar2(20) not null,
	     adrresse varchar2(20) not null,
	     datedemande date default sysdate
             );

create table adherant (
             ida int primary key,
             nom varchar2(10) not null,
             prenom varchar2(10) not null,
             email varchar2(20) not null,
	     adrresse varchar2(20) not null,
             nbrEmprunt int default 0 not null, check (0<=nbreEmprunt and nbreEmprunt<=3),
	     statut string default  'Ajour',
             dateinscription date default CURDATE();
             forfait int  default 2000 not null, check (0<=forfait and forfait<=2000);
             unique(idc, email)
             );
insert table adherant(idc, nom, prenom, email) values (seq_adherant.nextval, 'Amegandji', 'eddy', 'amegandji@gmail.com');
insert table adherant(idc, nom, prenom, email) values (seq_adherant.nextval, 'mehmet', 'nicolas', 'mehmet@u-psud.fr');
insert table adherant(idc, nom, prenom, email) values (seq_adherant.nextval, 'csouumou', 'hamala', 'csoumou@gmail.com');
 



create table bibliothecaire (
             idb int primary,
             nom varchar2(10) not null,
             prenom varchar2(10) not null,
             email varchar2(20) not null,
  	     unique(idb, email)
	     );
create table livre(
		idlivre int default 1 not nul
		auteur varchar2(10),
                ISBN varchar2(20)
		);

create table dvd(
		iddvdint default 2 not nul
     		duree varchar2(20)
		);
create table cd(
		idcd int default 3 not nul
		nom varchar2(10),
                classe int(20)
		);
create table revue(
		 idr int default 4 not nul,
                 dateRevue date,
                 numeroRevue int
		);

create table documents(
              idd int primary key,
              titre varchar2(12) not null,
              iddvd int, foreign key (iddvd) references dvd ,
              penalité int not null, check (0<=prix and prix<=100),
              dateAjout int not null, check (1<=capacite and capacite<=1000)
              nbreExemplaire int default 0 not null;
              --image varchar2(200) null not null,
              nbretotal int default 0 not null
              );

create table emprunt(
		ide int  primary key,
		ida int not null, foreign key (ida) references adherant ,
                idd int not null, foreign key (idd) references documents ,
		dateEmprunt date default CURDATE(),
		dateRetour  date default DATE_ADD(CURDATE , INTERVAL 14 DAY)
                
		);
create table reservation(
                idreser int primary key,
		ida int not null, foreign key (ida) references adherant ,
                idd int not null, foreign key (idd) references documents , 
                dateReservation date default CURDATE,
                delaiREservation date  default DATE_ADD(CURDATE , INTERVAL 3 DAY)
		);
drop table adherant;
drop table bibliothecaire;
drop table documents;
drop table emprunt;
drop table retour;
drop table reservation;
drop table livre;
drop table dvd;
drop table cd;
drop table revue;
		
drop sequence seq_adherant;
drop sequence seq_bibliothecaire;
drop sequence seq_documents;
drop sequence seq_emprunt;
drop sequence seq_retour;
drop sequence seq_reservation;

create sequence seq_adherant start with 1;
create sequence seq_bibliothecaire start with 1;
create sequence seq_documents start with 20;
create sequence seq_emprunt start with 1;
create sequence seq_retour start with 10;
create sequence seq_reservation start with 1;

	
		






create table sejour(
             ids int primary key,
             idc int not null, foreign key (idc) references client,
             idv int not null, foreign key (idv) references village,
             jour int not null, check(0<=jour and jour<=365),
             unique (idc, jour)
             );


drop sequence seq_client;
drop sequence seq_village;
drop sequence seq_sejour;

create sequence seq_client start with 1;
create sequence seq_village start with 10;
create sequence seq_sejour start with 100;


----------------------------------------------------------------
--------------employés------------------------
--------------------------------------------------------------
--1 creer des villages
insert into village values (seq_village.nextval, 'Kaye', 'Resto', 500, 100);
insert into village values (seq_village.nextval, 'Kaye', 'foot', 50, 90);
insert into village values (seq_village.nextval, 'Bamako', 'festival', 850, 750);

/* modele d'ordre

insert inte village values (seq_village.nextval, v, a, p, c)

*/


--2 consulter villages

select *from village

--3 modifier

update village
       SET capacite = capacite + 10,
           activite = 'Dansetradi'
       where activite = 'foot';



--4 Consuter les sejours

select *from sejour;

--5
select count(*) sejour
     where jour < 100;

delete sejour where jour < 100;
/* modele d'ordre
 traitement(le_jour)

select count(*) sejour
     where jour < le_jour;
   renvoie le resultant dans le nombre

delete sejour where jour < le_jour;
*/


-----------------------------------------------------------------
-------------Client--------------------
---------------------------------------------------------------

--6 traitement1

insert into client(idc, nom, age) values (seq_client.nextval, 'koumati', 40);

insert into client(idc, nom, age) values (seq_client.nextval, 'badjalou', 33);
/* modele d'ordre
traitement(nom, age)
l-idc=seq_client.nextval
insert into client(idc,nom,age) 
values(l_idc,l_nom, l_age);
traitement retour(l_idc)
*/

--7 traitement 2

--koumati identifiant 1 achete pour bamako pour 45
select idv, prix, activite from village
       where ville = 'Bamako'
	     order by prix;

update client
     SET avoir = avoir - 850
     where idc = 1 and nom = 'koumati';

insert into sejour values (seq_sejour.nextval, 1, 12, 45);


/* modele d'ordre
traitement(l_idc,l_ville,l_jour)
select idv,prix,activite from village
   where ville = l_ville
     order by prix;
renvoie le resultat dans idv,prix,ville
si le resultant existe 
l_ids=seq_sejour.nextval
insert into sejour(l_ids,idc,idv,l_jour)

update client
    SET avoir = avoir -l_prix
    where idc = l_idc and nom = l-nom;
sinon
 l_idc=-1
 l_idv=-1
 l_activite='neant'
*/

--8 consulter les villages pour les quels il ya auccun sejour

select idv, ville, activite, prix, capacite from village
         where idv  not in ( select idv from sejour);
             







