<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Récupère les données du formulaire
	$email = $_POST['Email'];
	$mot_de_passe = $_POST['mdp'];
	$nom = $_POST['Nom'];
	$prenom = $_POST['Prenom'];
	$sexe = $_POST['Sexe'];
	$date_naissance = $_POST['date_de_naissance'];
	$adresse = $_POST['Adresse'];
	$pseudo = $_POST['Pseudo'];
	$profession = $_POST['Profession'];
	$lieu = $_POST['Lieu'];
	$situation = $_POST['Situation'];
	$physique = $_POST['Physique'];
	$info = $_POST['Infos_Perso'];

	$donnees = "$email; $mot_de_passe; $nom; $prenom; $sexe; $date_naissance; $adresse; $pseudo; $profession; $lieu; $situation; $physique; $info\n";

	// Crée le dossier avec le nom de l'email
	if (!is_dir('users/'.$email)){
		mkdir('users'/.$email);
		}

	// Le fichier où les donnees sont enregistrées    
	$fichier = 'users/'.$email.'/donnees.csv';
	
	// Ecrit dans le fichier les données entrée a l'inscriprion
	$file = fopen($fichier, 'a');
	fwrite($file, $donnees);
	fclose($file);

	// Traiter les fichiers uploadés
	if (!empty($_FILES['images']['name'][0])) {
		foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
			$fileName = basename($_FILES['images']['name'][$key]);
			$targetFilePath = 'users/'.$email . '/' . $fileName;

			// Déplace le fichier vers le dossier cible
			if (move_uploaded_file($tmp_name, $targetFilePath)) {
				echo "Le fichier $fileName a été téléchargé avec succès.<br>";
			}
			else {
				echo "Erreur lors du téléchargement du fichier $fileName.<br>";
			}
		}
	}
	else {
		echo 'Aucun fichier téléchargé.';
	}
	
	// Met l'attribut VIP si c'est une femme
	if ($sexe=="Femme") {
		setcookie('VIP', 'true', time() + (10 * 365 * 24 * 60 * 60), '/');
	}
	
	header("Location: connexion.html");
	exit;
}
?>
