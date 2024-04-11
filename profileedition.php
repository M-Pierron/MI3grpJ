<!DOCTYPE html> 
<html> 
	<head>
		<link rel="stylesheet" type="text/css" href=".css">
		<script type="text/javascript"src=".js"></script>
	</head>
	<body>
		<form action="editing.php" method = "post">
			<label for="email"> Email : </label>
			<input type="text" id="email" name="email" value="<?php echo "email";?>"/>
			<br>
			<label for="mdp"> Mot de passe : </label>
			<input type="text" id="mdp" name="mdp" value="<?php echo "mdp";?>">
			<br>
			<label for="prenom"> Prenom : </label>
			<input type="text" id="prenom" name="prenom" value="<?php echo "prenom";?>"/>
			<br>
			<label for="nom"> Nom : </label>
			<input type="text" id="nom" name="nom" value="<?php echo "nom";?>">
			<br>
			<label for="pseudo"> Pseudo : </label>
			<input type="text" id="pseudo" name="pseudo" value="<?php echo "pseudo";?>"/>
			<br>
			<label for="age"> Age : </label>
			<input type="text" id="age" name="age" value="<?php echo "age";?>">
			<br>
			<label for="sexe"> Sexe : </label>
			<input type="text" id="sexe" name="sexe" value="<?php echo "sexe";?>">
			<br>
			<label for="taille"> Taille : </label>
			<input type="text" id="taille" name="taille" value="<?php echo "taille";?>"/>
			<br>
			<label for="poids"> Poids : </label>
			<input type="text" id="poids" name="poids" value="<?php echo "poids";?>"/>
			<br>
			<label for="centreinteret"> Centre d'interet : </label>
			<input type="text" id="centreinteret" name="centreinteret" value="<?php echo "centreinteret";?>"/>
			<br>
		</form>
		<a href=profile.php> <img src="retour.jpg" alt="image"/> </a>
		
	</body> 
</html>



