<?php
session_start();
if(!$_SESSION["email"]){
    exit("Vous n'êtes pas connecté.");
}

$email_session = $_SESSION['email'];
$email_correspondant = $_GET['email'];
$message_csv = fopen("MonJambonbeurre.fr/users/$email_session/log_messages", "r"); 
if ($message_csv) { 
    $lignes = file("MonJambonbeurre.fr/users/$email_session/log_messages", FILE_IGNORE_NEW_LINES); 
    foreach ($lignes as $ligne) {
        $elmt = explode(';', $ligne);
        if (($elmt[1] == $email_session && $elmt[2] == $email_correspondant) || ($elmt[2] == $email_session && $elmt[1] == $email_correspondant)) {
            echo '<div>';
            if ($elmt[1] ==  $email_session) {
                echo '<p>'. $elmt[0] . ' - ' . $elmt[1] . ' - ' . $elmt[3] . '</p>';
            } else {
                echo '<p>'. $elmt[0] . ' - ' . $elmt[2] . ' - ' . $elmt[3] . '</p>'; 
            }
            echo '</div>';
        }
    }
    fclose($message_csv);
} else {
    exit("Impossible d'ouvrir le fichier de messages.");
}
?>
