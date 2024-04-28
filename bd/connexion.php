<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=biblio','root','root');
} catch (Exception $e) {
    echo $e->getMessage();
}
?>