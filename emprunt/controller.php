<?php

require_once('../bd/connexion.php');

$action = isset($_POST['action']) ? $_POST['action'] : "";


if($action == 'create'){
    $codeEtudiant = $_POST['codeEtudiant'] ?? '';
    $codeLivre = $_POST['codeLivre'] ?? '';
    $dateEmprunt = $_POST['dateEmprunt'] ?? '';

    $req = $bdd->prepare('insert into emprunter(codeEtudiant,codeLivre,dateEmprunt) values(:codeEtudiant,:codeLivre,:dateEmprunt)');

    $result = $req->execute(
        array(
            'codeEtudiant' => $codeEtudiant,
            'codeLivre' => $codeLivre,
            'dateEmprunt' => $dateEmprunt
        )
    );

    if($result){
        header('Location:Emprunt/index.php?success=1');
    }else{
        header('Location:Emprunt/create.php?error=1');
    }
}



?>