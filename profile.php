<!DOCTYPE html> 
<html> 
<head>
    <link rel="stylesheet" type="text/css" href=".css">
    <script type="text/javascript" src=".js"></script>
</head>
<body>
    <table>
        <?php
		$email_session = $_SESSION["email"];
		$fp = fopen("MonJambonbeurre.fr/users/$email_session", "r");
		$trouve = false;
		while (($data = fgetcsv($fichier_csv, 1000, ";")) !== FALSE && !$trouve) {
			if ($data[0] == $email_session) {
				$trouve = true; 
				/* Faire le traitement des images*/
				echo "<tr>";
				echo "<td>Adresse mail</td><td>$data[0]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Mode de passe</td><td>$data[1]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Prenom</td><td>$data[2]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Nom</td><td>$data[3]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Pseudo</td><td>$data[4]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Age</td><td>$data[5]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Sexe</td><td>$data[6]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Taille</td><td>$data[7]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Poids</td><td>$data[8]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Centre d'interet</td><td>$data[9]</td>";
				echo "</tr>";
			}
		}
		fclose($fichier_csv);
        ?>
    </table>
		<form action="suppression.php" method="post">
			<input type="submit" value="Supprimer le profil">
		</form>
    <a href="profileedition.php"> <img src="editing.jpg" alt="image"/> </a>
</body> 
</html>
