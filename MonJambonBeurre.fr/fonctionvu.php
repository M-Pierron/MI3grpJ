<?php
// -- Si ils sont bloqués, ou non abonnés, les rediriges --
require_once('fonctionbloquer.php');
require_once('fonction_abonnee.php');
if (est_bloquer($_SESSION["email"], $_GET["email"]) || !(est_abonne($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
    }

// -- Inscrit l'utilisateur dans les vus de profil --
function vuduprofil($email_recepteur, $email_session) {
    $fichier_log = "users/$email_recepteur/log_vu";
    if (!file_exists($fichier_log)) {
        file_put_contents($fichier_log, ""); 
    }
    $emails_vus = file($fichier_log, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!in_array($email_session, $emails_vus)) {
        file_put_contents($fichier_log, $email_session . PHP_EOL, FILE_APPEND);
    }
}
?>
