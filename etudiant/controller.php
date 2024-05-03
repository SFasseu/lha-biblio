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
    //récupération de l'input type file
    $photo = $_FILES['photo'];

    //recupération du nom initial du fichier
    $photoName = $photo['name'];

    //Récupération de la taille du fichier
    $photoSize = $photo['size'];

    //Récupération de l'extension du fichier
    $photoExtention = pathinfo($photoName)['extension'];
   
    $newFileName = 'photo_'.time().'.'.$photoExtention;

    //Déplacement du fichier du repertoire temporaire vers /pictures
    move_uploaded_file($photo['tmp_name'], 'pictures/'.$newFileName);
    
    $req = $bdd->prepare('insert into etudiant(nom,prenom,classe,adresse,picture) values(:nom,:prenom,:classe,:adresse,:picture)');

    $result = $req->execute(
        array(
            'nom' => $nom,
            'prenom' => $prenom,
            'classe' => $classe,
            'adresse' => $adresse,
            'picture' => $newFileName
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
    //récupération de l'input type file
    $photo = $_FILES['photo'];

    //recupération du nom initial du fichier
    $photoName = $photo['name'];

    //Récupération de la taille du fichier
    $photoSize = $photo['size'];

    //Récupération de l'extension du fichier
    $photoExtention = pathinfo($photoName)['extension'];

    $newFileName = 'photo_'.time().'.'.$photoExtention;
   
    //Déplacement du fichier du repertoire temporaire vers /pictures
    move_uploaded_file($photo['tmp_name'], 'pictures/'.$newFileName);
    

    $code = $_POST['codeEtudiant'] ?? 0;

    $req1 = $bdd->prepare('select * from etudiant where codeEtudiant =:code');
    $req1->execute(
        array('code' => $code)
    );

    $etudiantExist = $req1->fetch();

    if($etudiantExist){
        $req = $bdd->prepare('update etudiant set classe=:classe, nom=:nom, prenom=:prenom, adresse=:adresse, picture=:picture where codeEtudiant=:code');
        $result = $req->execute(
        [
            'nom' => $nom,
            'prenom' => $prenom,
            'classe' => $classe,
            'adresse' =>$adresse,
            'picture' => $newFileName,
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