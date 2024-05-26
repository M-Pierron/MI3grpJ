<?php
session_start();
// Regarde si la session est ouverte
if (isset($_SESSION['email']){
	// Redirige vers la page suivante ou sinon d'acceuil
	$suivante=isset($_SESSION['suivante']) ? $_SESSION['suivante'] : 'acceuil.php';
	header("Location: $suivante");
	exit;
}

else{
	// Enregistre la page de départ dans la session
	if (!isset($_SESSION['redirect_to'])){
		$_SESSION['redirect_to'] = $_SERVER['HTTP_REFERER'];
	}

	// Redirige vers la page de connexion
	header("Location: connection.html");
}
?>
