<!DOCTYPE html> 
<html> 
	<head>
		<link rel="stylesheet" type="text/css" href="style.css"> 
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body>
		<form action="editing.php" method="post">
			<table>
				<?php
					require_once("displayprofile.php"); 
					display($_SESSION["email"], false);  
				?>
			</table>
			<input type="submit" value="Sauvegarder">
		</form>
		<a href="profile.php"> <img src="retour.jpg" alt="image"/> </a>
	</body> 
</html>
