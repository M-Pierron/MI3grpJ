<?php
session_start();


if (!isset($_SESSION['redirect_to'])){
	$_SESSION['redirect_to'] = $_SERVER['HTTP_REFERER'];
}


header("Location: connexion.html");
?>
