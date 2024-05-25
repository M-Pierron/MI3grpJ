<?php
session_start();
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}

$envoyeur = $_SESSION["email"];
$recepteur = $_GET['recepteur'];

$fichier_messages = "MonJambonbeurre.fr/users/$envoyeur/messages/$recepteur.csv";

if (file_exists($fichier_messages)) {
    $fp = fopen($fichier_messages, "r");
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $date = $data[0];
        $email_envoyeur = $data[1];
        $message = $data[2];
		if ($data[3]) {		
			echo "<p><strong>$email_envoyeur</strong> [$date]: $message</p>";
			if ($email_envoyeur == $envoyeur) {
				echo "<form action='suppressionmessage.php' method='post'>
						<input type='submit' value='Supprimer un message'>
					</form>"; 
			}
		}
		else {
			echo "<p><strong>$email_envoyeur</strong> [$date] : Message supprimé </p>";
		}
	}
    fclose($fp);
} else {
    echo "<p>Aucun message trouvé.</p>";
}
?>
