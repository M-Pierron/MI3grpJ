<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Récupère les données du formulaire
	$email = $_POST['Email'];
	$mot_de_passe = $_POST['mdp'];

	$donnees = "$email; $mot_de_passe\n";

	// Le fichier où les donnees sont enregistrées
	$fichier = 'donnees_inscription1.txt';

	$file = fopen($fichier, 'a');

	fwrite($file, $donnees);

	fclose($file);
    
	header("Location: inscription2.html");
	exit;
}
?>
