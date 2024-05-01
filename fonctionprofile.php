<?php
	function display($email_session, $check){
		if (isset($_SESSION["ID"])) {
			$fp = fopen("MonJambonbeurre.fr/users/$email_session/donnees", "r");
			$trouve = false;
			while (($data = fgetcsv($fp, 1000, ";")) !== FALSE && !$trouve) {
				if ($data[0] == $email_session) {
					$trouve = true;
					$email = $data[0];
					$motdepasse = $data[1];
					$nom = $data[2];
					$prenom = $data[3];
					$pseudo = $data[4];
					$age = $data[5];
					$sexe = $data[6];
					
					if ($check === true) {
						$email = "<input type='email' id='email' name='email' value='$email'>";
						$motdepasse = "<input type='password' id='mdp' name='mdp' value='$motdepasse'>";
						$nom = "<input type='text' id='nom' name='nom' value='$nom'>";
						$prenom = "<input type='text' id='prenom' name='prenom' value='$prenom'>";
						$pseudo = "<input type='text' id='pseudo' name='pseudo' value='$pseudo'>";
						$age = "<input type='text' id='age' name='age' value='$age'>";
						$sexe = "<input type='text' id='sexe' name='sexe' value='$sexe'>";
					}

					echo "<tr>";
					echo "<td>Adresse mail</td><td>$email</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Mode de passe</td><td>$motdepasse</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Nom</td><td>$nom<td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Prenom</td><td>$prenom</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Pseudo</td><td>$pseudo</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Age</td><td>$age</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Sexe</td><td>$sexe</td>";
					echo "</tr>";
				}
			}
			fclose($fp);
		}
	}
?>
