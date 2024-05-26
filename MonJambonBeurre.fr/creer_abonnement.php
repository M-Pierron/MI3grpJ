<?php
session_start();
// -- Verificateur de connexion --
if (!isset($_SESSION['email'])) {
    header("Location: accueil.php");
    exit;
}

$email = $_SESSION['email'];
$dossier = 'users/' . $email;
// -- Verifie si l'abonnement existe --
if (file_exists($dossier)) {
    $fichier = $dossier . '/abonnement.txt';
    $date_abonnement = date('Y-m-d');
    $date_expiration = date('Y-m-d', strtotime('+1 year'));

    $contenu = "Date d'abonnement: $date_abonnement\nDate d'expiration: $date_expiration";
    file_put_contents($fichier, $contenu);

   
    $_SESSION['message'] = "Vous êtes maintenant abonné jusqu'au $date_expiration.";
    header("Location: confirmation.php");
    exit;
} else {
    
    $_SESSION['error'] = "Le dossier utilisateur n'existe pas.";
    header("Location: verification.php");
    exit;
}
?>
