<?php
session_start();

$_SESSION['username'] = session_unset();

echo '<pre>';
var_dump($_SESSION);


?>