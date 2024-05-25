<?php
session_start();

// Enregistre la page de départ dans la session
if (!isset($_SESSION['redirect_to'])){
	$_SESSION['redirect_to'] = $_SERVER['HTTP_REFERER'];
}

// Redirige vers la page de connexion
header("Location: connexion.html");
?>
