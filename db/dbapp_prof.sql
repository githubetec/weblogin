create database dbapp_prof;
use dbapp_prof;

create table usuarios
(
  id int primary key auto_increment,
  nome varchar(50),
  login varchar(10),
  senha varchar(8)
);
insert into usuarios (nome,login,senha) values ("Fabio","fabio","senha");
insert into usuarios (nome,login,senha) values ("root","root","admin");

select * from usuarios;