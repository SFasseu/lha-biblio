<?php

require_once('../bd/connexion.php');

$action = isset($_POST['action']) ? $_POST['action'] : "";
$modifs = isset($_POST['modifier']) ? $_POST['modifier'] : "";



if($action == 'create'){
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $classe = $_POST['classe'] ?? '';
    $adresse = $_POST['adresse'] ?? '';

    $req = $bdd->prepare('insert into etudiant(nom,prenom,classe,adresse) values(:nom,:prenom,:classe,:adresse)');

    $result = $req->execute(
        array(
            'nom' => $nom,
            'prenom' => $prenom,
            'classe' => $classe,
            'adresse' => $adresse
        )
        );
    
    if($result){
        header('Location:index.php?success=1');
    }else{
        header('Location:create.php?error=1');
    }
}


if($modifs == 'update'){
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $classe = $_POST['classe'] ?? '';
    $adresse = $_POST['adresse'] ?? '';

	$nb_modifs="UPDATE etudiant SET nom=?,prenom=?,class=?,adress=? WHERE codeEtudiant=?";
	$param=array($nom,$prenom,$classe,$adresse);		
	$modifs = $bdd->prepare($nb_modifs);	
	$modifs->execute($param);	
	
    if($nb_modifs){
        header('Location:index.php?success=1');
    }else{
        header('Location:update.php?error=1');
    }
};



?>