<?php 
session_start();
if(!$_SESSION["email"]){
    exit("Vous n'êtes pas connecté.");
}

if(isset($_POST['message']) && !empty($_POST['message']) && isset($_GET['email']) && !empty($_GET['email'])){ 
    $heure_message = date('Y-m-d H:i:s');
    $envoyeur = $_SESSION["email"];
    $recepteur = $_GET['email'];
    $envoie_csv = fopen("MonJambonbeurre.fr/users/$envoyeur/log_messages", "a+"); 
    $reception_csv = fopen("MonJambonbeurre.fr/users/$recepteur/log_messages", "a+"); 
    $message = htmlspecialchars($_POST['message']);
    $inserer_message = "$heure_message;$envoyeur;$recepteur;$message"; 
    fwrite($envoie_csv, $inserer_message . PHP_EOL); 
    fwrite($reception_csv, $inserer_message . PHP_EOL); 
    fclose($envoie_csv);
    fclose($reception_csv);
} else {
    exit("Les données du message sont manquantes.");
}
?>
