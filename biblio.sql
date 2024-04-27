create database biblio;

use biblio;

create table etudiant(
    codeEtudiant int (50) primary key,
    nom varchar (60) not null,
    prenom varchar (50) default null,
    adresse varchar (50) not null,
<<<<<<< HEAD
    classe varchar (20) not null,
=======
    classe varchar (20) not null
>>>>>>> 8a6b1de542e6b0d6ae9f1da265a406ce07a2e971
)engine = InnoDB default charset = utf8;

create table livre(
    codeLivre int (50) primary key,
    titre varchar (60) not null,
    auteur varchar (60) not null,
<<<<<<< HEAD
    dateEdition date,
)engine = InnoDB default charset = utf8;

create table emprunter (
    codeEtudiant int (50),
    codeLivre int (50),
=======
    dateEdition date not null
)engine = InnoDB default charset = utf8;

create table emprunter (
    codeEtudiant int (50) not null,
    codeLivre int (50) not null,
>>>>>>> 8a6b1de542e6b0d6ae9f1da265a406ce07a2e971
    dateEmprunt date not null,
    foreign key (codeEtudiant) references etudiant (codeEtudiant),
    foreign key (codeLivre) references livre (codeLivre)
) engine = InnoDB default charset = utf8;