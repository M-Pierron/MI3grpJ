<?php 
session_start();
if(!$_SESSION["email"]){
	header('Location: accueil.php');
	exit;
}
$email_session = $_POST['email_session'];
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
					require_once("fonctionprofile.php"); 
					affichage($email_session, true, true);  
				?>
			</table>
			<input type="hidden" name="email_session" value="<?php echo $email_session; ?>">
			<input type="submit" value="Sauvegarder">
		</form>
		<form action="upload_image.php" method="post" enctype="multipart/form-data">
			<?php
			$repertoire_photos = "MonJambonbeurre.fr/utilisateurs/$email_session/photos/";
			if (is_dir($repertoire_photos)) {
				$photos = scandir($repertoire_photos);
				foreach ($photos as $photo) {
					if ($photo !== '.' && $photo !== '..') {
						echo "<label>";
						echo "<input type='radio' name='image_selectionnee' value='$photo'>";
						echo "<img src='$repertoire_photos/$photo' alt='Photo utilisateur'>";
						echo "</label>";
					}
				}
			}
			?>
			<label for="nouvelle_image">Choisissez une nouvelle image :</label>
			<input type="file" name="nouvelle_image" id="nouvelle_image">
			<input type="submit" value="Modifier">
		</form>

		<a href="profil.php"> <img src="image/retour.jpg" alt="image"/> </a>
	</body> 
</html>
