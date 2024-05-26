<?php
	
	function affichage($email_session, $verif, $prive) {
		$fp = fopen("users/$email_session/donnees.csv", "rt");
		$trouve = false;
		while (($data = fgetcsv($fp, 1000, ";")) !== FALSE && !$trouve) {
			if ($data[0] == $email_session) {
				$trouve = true;
				$email = htmlspecialchars($data[0]);
				$motdepasse = htmlspecialchars($data[1]);
				$prenom = htmlspecialchars($data[2]);
				$nom = htmlspecialchars($data[3]);
				$sexe = htmlspecialchars($data[4]);
				$age = htmlspecialchars($data[5]);
				$locaprecise = htmlspecialchars($data[6]);
				$pseudo = htmlspecialchars($data[7]);
				$profession = htmlspecialchars($data[8]);
				$loca = htmlspecialchars($data[9]);
				$situation = htmlspecialchars($data[10]);
				$description = htmlspecialchars($data[11]);
				$citation = htmlspecialchars($data[12]);

				if ($verif === true) {
					$motdepasse = "<input type='password' id='mdp' name='mdp' value='$motdepasse'>";
					$nom = "<input type='text' id='nom' name='nom' value='$nom'>";
					$prenom = "<input type='text' id='prenom' name='prenom' value='$prenom'>";
					$locaprecise = "<input type='text' id='locaprecise' name='locaprecise' value='$locaprecise'>";
					$pseudo = "<input type='text' id='pseudo' name='pseudo' value='$pseudo'>";
					$profession = "<input type='text' id='profession' name='profession' value='$profession'>";
					$loca = "<input type='text' id='loca' name='loca' value='$loca'>";
					$situation = "<input type='text' id='situation' name='situation' value='$situation'>";
					$description = "<textarea id='description' name='description'>$description</textarea>";
					$citation = "<textarea id='citation' name='citation'>$citation</textarea>";
				}
				if ($prive === true) {
					echo "<tr><td>Adresse mail</td><td>$email</td></tr>";
					echo "<tr><td>Mot de passe</td><td>$motdepasse</td></tr>";
					echo "<tr><td>Nom</td><td>$nom</td></tr>";
					echo "<tr><td>Prenom</td><td>$prenom</td></tr>";
					echo "<tr><td>Localisation Précise</td><td>$locaprecise</td></tr>";
				}

				echo "<tr><td>Pseudo</td><td>$pseudo</td></tr>";
				echo "<tr><td>Age</td><td>$age</td></tr>";
				echo "<tr><td>Sexe</td><td>$sexe</td></tr>";
				echo "<tr><td>Profession</td><td>$profession</td></tr>";
				echo "<tr><td>Localisation</td><td>$loca</td></tr>";
				echo "<tr><td>Situation</td><td>$situation</td></tr>";
				echo "<tr><td>Description</td><td>$description</td></tr>";
				echo "<tr><td>Citation</td><td>$citation</td></tr>";
				
				if ($verif === false) {
				$dossier_photos = "users/$email_session/photos/";  
					$photos = scandir($dossier_photos);
					foreach ($photos as $photo) {
						if ($photo !== '.' && $photo !== '..') {
							echo "<tr>";
							echo "<td>Photo</td><td><img src='$dossier_photos/$photo' alt='Photo utilisateur'></td>";
							echo "</tr>";
						}
					}
				}
				
			}
		}
		fclose($fp);
	}
?>
