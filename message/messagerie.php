<?php 
session_start();
if(!$_SESSION["email"]){
	header('Location: accueil.php');
	exit;
}

if(isset($_GET['email']) && !empty($_GET['email'])){ 
	$heure_message = date('Y-m-d H:i:s');
	$envoyeur = $_SESSION["email"];
	$recepteur = $_GET['email'];
	$envoie_csv = fopen("MonJambonbeurre.fr/users/$envoyeur/log_messages", "a+"); // 
	$reception_csv = fopen("MonJambonbeurre.fr/users/$recepteur/log_messages", "a+"); 
	$message = htmlspecialchars($_POST['message']);
	$inserer_message = "$heure_message;$envoyeur;$recepteur;$message"; 
	fwrite($envoie_csv, $inserer_message . PHP_EOL); 
	fwrite($reception_csv, $inserer_message . PHP_EOL); 
	fclose($envoie_csv);
	fclose($reception_csv);
}

else {
	header('Location: erreur.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form method="POST" action="">
	<textarea name="message"></textarea>
	<input type="submit" name="envoyer">
</form>

<?php 
$email_session = $_SESSION['email'];
$email_correspondant = $_GET['email'];
$message_csv = fopen("MonJambonbeurre.fr/users/$email_session/log_messages", "r"); 
if ($message_csv) { 
	$lignes = file($message_csv, FILE_IGNORE_NEW_LINES); 
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
?>
</body>
</html>
