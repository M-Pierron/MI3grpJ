<?php 
session_start();
if(!$_SESSION["email"]){
	header('Location: accueil.php');
	exit;
}
?>

<!DOCTYPE html> 
<html> 
	<head>
		<link rel="stylesheet" type="text/css" href="style.css"> 
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body>
		<form action="edition.php" method="post">
			<table>
				<?php
					require_once("displayprofile.php"); 
					affichage($_SESSION["email"], true);  
				?>
			</table>
			<input type="submit" value="Sauvegarder">
		</form>
		<a href="profile.php"> <img src="retour.jpg" alt="image"/> </a>
	</body> 
</html>
