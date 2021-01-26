<?php
//On lance ou on récupère la session
session_start();

//Mettre ici tous les fichiers à inclure
require_once('language.php');
require_once('basket.php');

function returnPage($page){
    $_SESSION['returnPage'] = $page;
}
?>


