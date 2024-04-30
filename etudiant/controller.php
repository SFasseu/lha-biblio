<?php
//récupération de la connexion à la BD
require_once('../bd/connexion.php');

//variable $action permettant de déterminer l'action à effectuer en fonction du formulaire
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

//récupération des champs de formulaires
$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$classe = $_POST['classe'] ?? '';
$adresse = $_POST['adresse'] ?? '';

//processus de création d'un étudiant
if($action == 'create'){
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

//processus de mise à jour d'un étudiant
elseif($action == 'update'){
    $code = $_POST['codeEtudiant'] ?? 0;

    $req1 = $bdd->prepare('select * from etudiant where codeEtudiant =:code');
    $req1->execute(
        array('code' => $code)
    );

    $etudiantExist = $req1->fetch();

    if($etudiantExist){
        $req = $bdd->prepare('update etudiant set classe=:classe, nom=:nom, prenom=:prenom, adresse=:adresse where codeEtudiant=:code');
        $result = $req->execute(
        [
            'nom' => $nom,
            'prenom' => $prenom,
            'classe' => $classe,
            'adresse' =>$adresse,
            'code' => $code
        ]
        );

        if($result){
            header('Location:index.php?success=1');
        }else{
            header('Location:create.php?error=1');
        }
    }else header('Location:index.php?error=undefined');
}

elseif($action == 'delete'){
    $code = $_REQUEST['codeEtudiant'] ?? 0;

    $req1 = $bdd->prepare('select * from etudiant where codeEtudiant =:code');
    $req1->execute(
        array('code' => $code)
    );

    $etudiantExist = $req1->fetch();
    if($etudiantExist){
        $bdd->exec('delete from etudiant where codeEtudiant='.$code);
        header('Location:index.php?success=1');
    }
}



?>