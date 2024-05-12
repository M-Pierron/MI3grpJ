<?php
	session_start();
	if(!$_SESSION["email"]){
		header('Location: accueil.php');
		exit;
	}
	$email_session = $_SESSION["email"];
	$fichier_csv = fopen("MonJambonbeurre.fr/users/$email_session/donnees", "r+");
	$donnees = [];
	while (($data = fgetcsv($fichier_csv, 1000, ";")) !== FALSE) {
		$donnees[] = $data;
	}
	foreach ($donnees as &$ligne) {
		if ($ligne[0] == $_SESSION["email"]) {
			$ligne[1] = $_POST["mdp"];
			$ligne[2] = $_POST["nom"];
			$ligne[3] = $_POST["prenom"];
			$ligne[4] = $_POST["pseudo"];
			$ligne[5] = $_POST["age"];
			$ligne[6] = $_POST["sexe"];
			$ligne[7] = $_POST["taille"];
			$ligne[8] = $_POST["poids"];
			$ligne[9] = $_POST["centreinteret"];
			break;
		}
	}
	rewind($fichier_csv);

	foreach ($donnees as $ligne) {
		fputcsv($fichier_csv, $ligne, ";");
	}

	fclose($fichier_csv);
	header("Location: profile.php");
	exit;
?>