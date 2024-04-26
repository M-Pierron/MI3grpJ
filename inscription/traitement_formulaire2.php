<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Récupère les données du formulaire
	$nom = $_POST['Nom'];
	$prenom = $_POST['Prenom'];
	$sexe = $_POST['Sexe'];
	$date_naissance = $_POST['date_de_naissance'];
	$adresse = $_POST['Adresse'];

	$donnees = "$nom; $prenom; $sexe; $date_naissance; $adresse\n";

	// Le fichier où les donnees sont enregistrées
	$fichier = 'donnees_inscription2.txt';

	$file = fopen($fichier, 'a');

	fwrite($file, $donnees);

	fclose($file);
	//passe a la page suivante
	header("Location: inscription3.html");
	exit;
}
?>
