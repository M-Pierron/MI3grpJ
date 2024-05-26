<?php
session_start();
// -- Verificateur de connexion --
if(!isset($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
}
// -- Fonction récursive, qui supprile le dossier et ce qu'il y a dedans -- 
function supprimer_dossier($directory) {
    if (!is_dir($directory)) {
        return false;
    }

    $contenu = glob($directory . '/*');
    foreach ($contenu as $element) {
        if (is_dir($element)) {
            supprimer_dossier($element);
        } else {
            if (!unlink($element)) {
                return false; 
            }
        }
    }

    return rmdir($directory);
}
// -- Mise en place de la suppression
if (isset($_POST["email"])) {
    $email_session = basename($_POST["email"]); 
    $directory_to_delete = __DIR__ . "/users/$email_session"; 

    if (is_dir($directory_to_delete)) {
        if (supprimer_dossier($directory_to_delete)) {
            header("Location: accueil.php");
            exit;
        } else {
            echo "Erreur lors de la suppression du dossier.";
        }
    } else {
        echo "Le dossier n'existe pas.";
    }
} else {
    header("Location: accueil.php");
    exit;
}
?>
