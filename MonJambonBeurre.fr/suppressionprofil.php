<?php
session_start();
if(!$_SESSION["email"]){
	header('Location: accueil.php');
	exit;
}

function supprimer_dossier("MonJambonbeurre.fr/users/$email_session") {
    if (!is_dir("MonJambonbeurre.fr/users/$email_session")) {
        return false;
    }
    
    $contenu = glob($"MonJambonbeurre.fr/users/$email_session" . '/*');
    foreach ($contenu as $element) {
        if (is_dir($element)) {
            supprimer_dossier($element);
        } else {
            unlink($element);
        }
    }
    
    return rmdir($"MonJambonbeurre.fr/users/$email_session");
}

$email_session = $_POST["email"];
supprimer_dossier("MonJambonbeurre.fr/users/$email_session"); 

header("Location: accueil.php");
?>