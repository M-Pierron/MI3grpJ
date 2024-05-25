<?php
	session_start();
	if(!$_SESSION["email"]){
		header('Location: accueil.php');
		exit;
	}
	$email_session = $_SESSION["email"];
	$fileold = "users/$email_session";
	$filenew = "archive/users/$email_session"; 
	rename($fileold, $filenew);
	header("Location: accueil.php");
	exit;
?>