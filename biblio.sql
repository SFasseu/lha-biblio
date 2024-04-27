create database biblio;

use biblio;

create table etudiant(
    codeEtudiant int (50) primary key,
    nom varchar (60) not null,
    prenom varchar (50) default null,
    adresse varchar (50) not null,
    classe varchar (20) not null,
)engine = InnoDB default charset = utf8;

create table livre(
    codeLivre int (50) primary key,
    titre varchar (60) not null,
    auteur varchar (60) not null,
    dateEdition date,
)engine = InnoDB default charset = utf8;

create table emprunter (
    codeEtudiant int (50),
    codeLivre int (50),
    dateEmprunt date not null,
    foreign key (codeEtudiant) references etudiant (codeEtudiant),
    foreign key (codeLivre) references livre (codeLivre)
) engine = InnoDB default charset = utf8;