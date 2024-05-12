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
			require_once("fonctionprofile.php"); 
		   affichage($_SESSION["email"], false); 
		 ?>
		</table>
			<form action="desactivationprofile.php" method="post">
				<input type="submit" value="Desactiver le profil">
			</form>
			<form action="suppressionprofile.php" method="post">
				<input type="submit" value="Supprimer le profil">
			</form>
		<a href="editionprofile.php"> <img src="editing.jpg" alt="image"/> </a>
	</body> 
</html>
