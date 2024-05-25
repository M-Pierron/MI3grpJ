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
		<table>
		<?php 
			require_once("fonctionprofil.php"); 
		   affichage($_SESSION["email"], false, true); 
		 ?>
		</table>
			<form action="desactivationprofil.php" method="post">
				<input type="submit" value="Desactiver le profil">
			</form>
			<form action="suppressionprofil.php" method="post">
				<input type="submit" value="Supprimer le profil">
			</form>
		<a href="mesbloques.php"> Bloques </a>
		<a href="mesvusdeprofil.php"> Bloques </a>
		<a href="editionprofil.php"> <img src="image/editing.jpg" alt="image"/> </a>
	</body> 
</html>
