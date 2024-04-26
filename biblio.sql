create database biblio;

use bibliotheque;

create table etudiant(
    codeEtudiant int (50) primary key auto_increment,
    nom varchar (60) not null,
    prenom varchar (50) default null,
    adresse varchar (50) not null,
    classe varchar (20) not null,
    photoEtudiant blob not null
);

create table livre(
    codeLivre int (50) primary key auto_increment,
    titre varchar (60) not null,
    auteur varchar (60) not null,
    dateEdition date default null,
    photoLivre blob not null
);

create table emprunter (
    codeEtudiant int (50),
    codeLivre int (50),
    dateEmprunt TIMESTAMP,
    foreign key (codeEtudiant) references etudiant (codeEtudiant),
    foreign key (codeLivre) references livre (codeLivre)
) engine = InnoDB default charset = utf8;