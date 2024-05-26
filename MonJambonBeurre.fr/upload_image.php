<?php
session_start();
// -- Verification de connexion --
if (!$_SESSION["email"]) {
    header('Location: accueil.php');
    exit;
}
// -- Mets à jour le dossier photo --
$email_session = $_POST['email'];
if ($_FILES['nouvelle_image']['error'] === UPLOAD_ERR_OK) {
    $dossier_cible = "MonJambonbeurre.fr/utilisateurs/$email_session/photos/";
    $fichier_cible = $dossier_cible . basename($_FILES["nouvelle_image"]["name"]);
    $uploadOk = true;
    $type_fichier_image = strtolower(pathinfo($fichier_cible, PATHINFO_EXTENSION));
    // -- Verifie la taille et le format des fichiers donnés --
    $infos_image = getimagesize($_FILES["nouvelle_image"]["tmp_name"]);
    if ($infos_image !== false) {
        $uploadOk = true;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = false;
    }

    if (file_exists($fichier_cible)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = false;
    }

    if ($_FILES["nouvelle_image"]["size"] > 500000) {
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = false;
    }

    if ($type_fichier_image != "jpg" && $type_fichier_image != "png" && $type_fichier_image != "jpeg"
        && $type_fichier_image != "gif") {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = false;
    }
// -- Si cela n'a pas marché", erreur --
    if ($uploadOk == false) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["nouvelle_image"]["tmp_name"], $fichier_cible)) {
            echo "Le fichier " . htmlspecialchars(basename($_FILES["nouvelle_image"]["name"])) . " a été téléchargé.";
        } else {
            echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
} else {
    echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
}
?>
