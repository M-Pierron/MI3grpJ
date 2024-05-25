<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: accueil.php");
    exit;
}

$email = $_SESSION['email'];
$dossier = 'users/' . $email;

if (file_exists($dossier)) {
    $fichier = $dossier . '/abonnement.txt';
    $date_abonnement = date('Y-m-d');
    $date_expiration = date('Y-m-d', strtotime('+1 year'));

    $contenu = "Date d'abonnement: $date_abonnement\nDate d'expiration: $date_expiration";
    file_put_contents($fichier, $contenu);

    // Message de confirmation
    $_SESSION['message'] = "Vous êtes maintenant abonné jusqu'au $date_expiration.";
    header("Location: confirmation.php");
    exit;
} else {
    // Si le dossier n'existe pas, rediriger avec une erreur
    $_SESSION['error'] = "Le dossier utilisateur n'existe pas.";
    header("Location: verification.php");
    exit;
}
?>
