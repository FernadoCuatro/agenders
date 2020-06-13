drop database if exists agenders;
create database agenders;
use agenders;
create table usuario
(
idus int AUTO_INCREMENT,
primary key(idus),
nombre varchar(25),
apellido varchar(25),
email varchar(50),
pw varchar(50)
);
create table contactos
(
id int AUTO_INCREMENT,
primary key(id),
nombre varchar(25),
apellido varchar(25),
telefono varchar(15),
email varchar(50),
foto longblob,
apuntes text(200),
idus int,
constraint fk_userid foreign key
(idus) references usuario(idus)
);
create table notas
(
idno int AUTO_INCREMENT,
primary key(idno),
notas text(700),
idus int,
constraint fk_notid foreign key
(idus) references usuario(idus)
);
/* PA */
use agenders;
drop procedure if exists age_usu; 
create procedure age_usu()
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM usuario;
use agenders;
drop procedure if exists age_con; 
create procedure age_con()
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM contactos;
use agenders;
drop procedure if exists age_not; 
create procedure age_not()
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM notas;
/* INDEX */
use agenders;
DROP PROCEDURE if exists ini_user;
CREATE PROCEDURE ini_user
(in email2 varchar(50), in pasw2 varchar(50))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM usuario WHERE email = email2 and pw = pasw2;
/* REGISTRO */
use agenders;
drop procedure if exists bus_cor; 
create procedure bus_cor
(in email2 varchar(50))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM usuario WHERE email = email2;
/*  */
use agenders;
drop procedure if exists inser_us; 
create procedure inser_us
(in nombre varchar(25),in apellido varchar(25),  in email varchar(50), in contrasenia varchar(50))
not deterministic contains sql sql security 
definer
INSERT INTO usuario
VALUES ('NULL', nombre, apellido, email, contrasenia);
/* CONTACTOS */
use agenders;
drop procedure if exists mos_con_idus; 
create procedure mos_con_idus
(in idus1 int)
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM contactos WHERE idus = idus1;
/* == */
use agenders;
drop procedure if exists mos_us_idus; 
create procedure mos_us_idus
(in idus2 int)
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM usuario WHERE idus = idus2;
/* CREEARR */
use agenders;
drop procedure if exists ins_con; 
create procedure ins_con 
(in nombre varchar(25),in apellido varchar(25),  in telefono varchar(15), in email varchar(50), in foto longblob, in apuntes text(200), idus int)
not deterministic contains sql sql security 
definer
INSERT INTO contactos
VALUES ('NULL', nombre, apellido, telefono, email, foto, apuntes, idus);
/* VVVERRR  = EDITAAR */
use agenders;
drop procedure if exists ver_cor; 
create procedure ver_cor
(in id1 varchar(50))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM contactos WHERE id = id1;
/* ELIMINAR */
use agenders;
drop procedure if exists del_cor; 
create procedure del_cor
(in id1 varchar(50))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER DELETE FROM contactos WHERE id = id1;
/* ACTUALIZARR */ 
use agenders;
drop procedure if exists act_con; 
create procedure act_con
(in nombre2 varchar(25),in apellido2 varchar(25),in telefono2 varchar(15),in email2 varchar(50),in foto2 longblob,in apuntes2 text(200), in id2 int)
not deterministic contains sql sql security 
definer 
update contactos set nombre = nombre2, apellido = apellido2, telefono = telefono2, email = email2, foto = foto, apuntes = apuntes2 WHERE id = id2;
/* NOTAS */ 
use agenders;
drop procedure if exists mos_not_idus; 
create procedure mos_not_idus
(in idus1 int)
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM notas WHERE idus = idus1;
/* EDITAR VEER */
use agenders;
drop procedure if exists ver_not; 
create procedure ver_not
(in idno2 varchar(50))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER SELECT * FROM notas WHERE idno = idno2;
/* ACTUALIZAR NOTAS */ 
use agenders;
drop procedure if exists act_no; 
create procedure act_no
(in nota2 text(200), in idno2 int)
not deterministic contains sql sql security 
definer 
update notas set notas = nota2 WHERE idno = idno2;
/* ELIMINAR */
use agenders;
drop procedure if exists del_no; 
create procedure del_no
(in idno1 varchar(50))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY 
DEFINER DELETE FROM notas WHERE idno = idno1;
/* AGREGAAR */
use agenders;
drop procedure if exists agg_not; 
create procedure agg_not 
(in notas text(200),in idus int)
not deterministic contains sql sql security 
definer
INSERT INTO notas
VALUES ('NULL', notas, idus);