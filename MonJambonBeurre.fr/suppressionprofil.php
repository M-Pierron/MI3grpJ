<?php
session_start();
if(!$_SESSION["email"]){
    header('Location: accueil.php');
    exit;
}

function supprimer_dossier($directory) {
    if (!is_dir($directory)) {
        return false;
    }

    $contenu = glob($directory . '/*');
    foreach ($contenu as $element) {
        if (is_dir($element)) {
            supprimer_dossier($element);
        } else {
            unlink($element);
        }
    }

    return rmdir($directory);
}

$email_session = $_POST["email"];
supprimer_dossier("users/$email_session"); 

header("Location: accueil.php");
?>