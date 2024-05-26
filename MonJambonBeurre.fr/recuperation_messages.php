<?php
session_start();
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}

$envoyeur = htmlspecialchars($_GET["email"]);
$recepteur = htmlspecialchars($_GET['recepteur']);

$fichier_messages = "users/$envoyeur/messages/$recepteur.csv";

if (file_exists($fichier_messages)) {
    $fp = fopen($fichier_messages, "r");
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $date = $data[0];
        $email_envoyeur = $data[1];
        $message = $data[2];
        $deleted = $data[3];

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
