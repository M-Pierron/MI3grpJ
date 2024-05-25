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
				<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
				<input type="submit" value="Supprimer le profil">
			</form>
		<a href="mesbloques.php"> Bloques </a>
		<a href="mesvusdeprofil.php"> Vus de profil </a>
		<form action="editionprofil.php" method="post">
			<input type="hidden" name="email_session" value="<?php echo $_SESSION; ?>">
			<input type="image" src="image/editing.jpg" alt="Modifier le profil">
		</form>
	</body> 
</html>
