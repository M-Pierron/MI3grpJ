<?php
	$fichier_csv = fopen("donnees.csv", "r+");

	$donnees = [];
	while (($data = fgetcsv($fichier_csv, 1000, ";")) !== FALSE) {
		$donnees[] = $data;
	}
	foreach ($donnees as &$ligne) {
		if ($ligne[0] == $_SESSION["ID"]) {
			$ligne[1] = $_POST["email"];
			$ligne[2] = $_POST["mdp"];
			$ligne[3] = $_POST["nom"];
			$ligne[4] = $_POST["prenom"];
			$ligne[5] = $_POST["pseudo"];
			$ligne[6] = $_POST["age"];
			$ligne[7] = $_POST["sexe"];
			$ligne[8] = $_POST["taille"];
			$ligne[9] = $_POST["poids"];
			$ligne[10] = $_POST["centreinteret"];
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
