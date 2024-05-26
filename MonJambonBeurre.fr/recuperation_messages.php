<?php
session_start();
// -- Verificateur de connexion --
if (!isset($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
}

$envoyeur = htmlspecialchars($_GET["email"]);
$recepteur = htmlspecialchars($_GET['recepteur']);

$fichier_messages = "users/$envoyeur/messages/$recepteur.csv";
// -- recupere les messages, pour les afficher --
if (file_exists($fichier_messages)) {
    $fp = fopen($fichier_messages, "r");
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $date = $data[0];
        $email_envoyeur = $data[1];
        $message = $data[2];
        $deleted = $data[3];
        // -- Verifie la suppression, sinon l'affiche --
        if ($deleted == 1) {
            echo "<p><strong>$email_envoyeur</strong> [$date]: Message supprimé</p>";
        } else {
            echo "<p><strong>$email_envoyeur</strong> [$date]: $message</p>";
            if ($email_envoyeur == $envoyeur) {
                echo "<form class='deleteMessageForm' action='suppressionmessage.php' method='post'>
                        <input type='hidden' name='timestamp' value='$date'>
                        <input type='hidden' name='envoyeur' value='$envoyeur'>
                        <input type='hidden' name='recepteur' value='$recepteur'>
                        <input type='submit' value='Supprimer un message'>
                    </form>";
            }
        }
    }
    fclose($fp);
} else {
    echo "<p>Aucun message trouvé.</p>";
}
