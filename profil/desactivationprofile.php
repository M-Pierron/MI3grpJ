<?php
	session_start();
	if(!$_SESSION["email"]){
		header('Location: accueil.php');
		exit;
	}
	$email_session = $_SESSION["email"];
	$fileold = "MonJambonbeurre.fr/users/$email_session";
	$filenew = "MonJambonbeurre.fr/archive/users/$email_session"; 
	rename($fileold, $filenew);
	header("Location: accueil.php");
	exit;
?>