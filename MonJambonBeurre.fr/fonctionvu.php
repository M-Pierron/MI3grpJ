<?php
function vuduprofil($email_recepteur, $email_session) {
    $fichier_log = "MonJambonbeurre.fr/users/$email_recepteur/log_vu";
    if (!file_exists($fichier_log)) {
        file_put_contents($fichier_log, ""); 
    }
    $emails_vus = file($fichier_log, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!in_array($email_session, $emails_vus)) {
        file_put_contents($fichier_log, $email_session . PHP_EOL, FILE_APPEND);
    }
}
?>
