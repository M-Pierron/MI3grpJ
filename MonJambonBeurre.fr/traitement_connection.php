<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	// Récupère les données du formulaire
	$email = $_POST['Email']?? '';
	$mot_de_passe = $_POST['mdp']??'';

	$dossier=$email;
	$fichier=$email.'/donnees_inscription.txt';
	echo $email.'<br>';
	echo $mot_de_passe.'<br>';
	
	if(is_dir($dossier) && file_exists($fichier)){
		$contenu=file_get_contents($fichier);
		$tab = explode("; ", $contenu);
		echo $tab[0].'<br>';
		echo $tab[1].'<br>';
		echo $tab[2].'<br>';
		
		if ($email === $tab[0] && $mot_de_passe === $tab[1]){
			$_SESSION['email'] = $email;
			$_SESSION['loggedin'] = true;
			header('Location: https://cytech.cyu.fr/');
			exit;
			}
		else{
			echo 'mdp incorrect';
			}
		}
	else{
		echo 'utilisateur pas trouvé';
		}
	}
        	
?>
