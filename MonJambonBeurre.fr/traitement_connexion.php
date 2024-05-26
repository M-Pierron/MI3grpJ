<?php
// -- Si le formulaire est rempli, verifie et execute la connexion --
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	
	$email = $_POST['Email']?? '';
	$mot_de_passe = $_POST['mdp']??'';
	$_SESSION['email']= $email;

	$dossier='users/'.$email;
	 $fichier='users/'.$email.'/donnees.csv';
	echo $email.'<br>';
	echo $mot_de_passe.'<br>';
	
	if(is_dir($dossier) && file_exists($fichier)){
		$contenu=file_get_contents($fichier);
		$tab = explode("; ", $contenu);

		if ($email === $tab[0] && $mot_de_passe === $tab[1]){
			$_SESSION['email'] = $email;
			$_SESSION['loggedin'] = true;
			$redirect_to = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : 'accueil.php'; 
				unset($_SESSION['redirect_to']); 

				
				header("Location: $redirect_to");
			}
		else{
			header("Location: connexion.html") ;
			}
		}
	else{
		echo 'utilisateur pas trouvé';
		}
	}
        	
?>
