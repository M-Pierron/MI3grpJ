<?php
	$fileold = "MonJambonbeurre.fr/users/$email_session";
	$filenew = "MonJambonbeurre.fr/archive/users/$email_session";
	rename($fileold, $filenew);
	header("Location: accueil.php");
	exit;
?>