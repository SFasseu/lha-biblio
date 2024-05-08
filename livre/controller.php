<?php

require_once('../bd/connexion.php');

$action = isset($_POST['action']) ? $_POST['action'] : "";


if($action == 'create'){
    $titre = $_POST['titre'] ?? '';
    $auteur = $_POST['auteur'] ?? '';
    $dateEdition = $_POST['dateEdition'] ?? '';

    $req = $bdd->prepare('insert into livre(titre,auteur,dateEdition) values(:titre,:auteur,:dateEdition)');

    $result = $req->execute(
        array(
            'titre' => $titre,
            'auteur' => $auteur,
            'dateEdition' => $dateEdition
        )
    );

    if($result){
        header('Location:livre/index.php?success=1');
    }else{
        header('Location:livre/create.php?error=1');
    }
}



?>