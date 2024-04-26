<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Récupère les données du formulaire
	$pseudo = $_POST['Pseudo'];
	$profession = $_POST['Profession'];
	$lieu = $_POST['Lieu'];
	$situation = $_POST['Situation'];
	$physique = $_POST['Physique'];
	$info = $_POST['Infos_Perso'];

	$donnees = "$pseudo; $profession; $lieu; $situation; $physique; $info\n";
	
	// Le fichier où les donnees sont enregistrées
	$fichier = 'donnees_inscription3.txt';

	$file = fopen($fichier, 'a');

	fwrite($file, $donnees);

	fclose($file);
	//passe a la page suivante
	header("Location: https://www.mediapart.fr/");
	exit;
}
?>
