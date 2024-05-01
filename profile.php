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
		   display($_SESSION["email"], false); 
		 ?>
		</table>
			<form action="suppression.php" method="post">
				<input type="submit" value="Supprimer le profil">
			</form>
		<a href="profileedition.php"> <img src="editing.jpg" alt="image"/> </a>
	</body> 
</html>
