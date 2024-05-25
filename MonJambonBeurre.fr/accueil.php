<?php
session_start();
$dossier='users';
$tablesdossiers=array_diff(scandir($dossier), array('..', '.'));;

// Fonction pour lire et extraire les informations du profil
function recupinfo($nomfichier) {
    if (($fichier = fopen($nomfichier, 'r')) !== false) {
        $ligne = fgetcsv($fichier, 0, ';');
        fclose($fichier);

        if ($ligne !== false) {
            $infos = [
			'pseudo' => $ligne[7],'sexe' => strtolower($ligne[4]),'mail' =>$ligne[0]];
            return  $infos;
			//implode(' ', $infos);
        }
    }
    return null;
}

// Parcourir les fichiers et récupérer informations à afficher

$results = [];
foreach ($tablesdossiers as $tablesdossiers) {
	//$sousdossier=$tablesdossiers;
	$fichier="users/$tablesdossiers/donnees.csv";
    $result = recupinfo($fichier);
    if ($result !== null) {
        $results[] = $result;
    } else {
        $results[] = "Le fichier n'a pas pu être ouvert.";
    }
}

// Vérifier si une recherche a été effectuée
$recherche = '';
if (isset($_POST['recherche'])) {
    $recherche = strtolower(trim($_POST['recherche']));
}
// vérifie si l'utilisateur est abonné
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$is_abonne = true;

if ($email) {
    $fichier_abonnement = "users/$email/abonnement.txt";
    if (file_exists($fichier_abonnement)) {
        $date_abonnement = file_get_contents($fichier_abonnement);
        $date_expiration = date('Y-m-d', strtotime($date_abonnement . ' +1 year'));
        $date_actuelle = date('Y-m-d');
        
        if ($date_actuelle <= $date_expiration) {
            $is_abonne = false;
        }
    }
}
if (is_file('users/$_SESSION["email"]/admin.csv')) {
 echo "<form method='POST' action='panel_admin.php'><button type='submit'>Admin</button></form>";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="CSS/accueil.css" rel="stylesheet">
<script src="JS/filtreaccueil.js" defer></script>
</head>
<body>
	<form method="POST" action=" ">
		<input type="text" name="recherche" placeholder="Rechercher..." />
		<input type="submit" value="Valider" />
	</form>
	<div>
		<input type="radio" name="sexe" value="all" checked="checked" /> Tous
		<input type="radio" name="sexe" value="homme"  /> Homme
		<input type="radio" name="sexe" value="femme"  /> Femme
	</div>
	<?php if (!$is_abonne): ?>
		<form method="POST" action="abonnement.php" align="center">
			<button type="submit">ABONNEZ-VOUS</button>
		</form>
	<?php endif; ?>
	<form method="POST" action="traitement_deconnexion.php">
	<button type="submit" id="deco">Deconnexion<img src="image/croix.png" width="17" height="17"></button>
	</form>
	<form method="POST" action="conversation_message.php">
		<button type="submit" id="msg">mesmessages</button>
		<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
	</form>
	
	<ul>
	<?php
        foreach ($results as $result) {
			$pseudo = htmlspecialchars($result['pseudo']);
			$sexe = htmlspecialchars($result['sexe']);
			$email= htmlspecialchars($result['mail']);
            // Si une recherche a été effectuée, filtrer les résultats
            if ($recherche === '' || strpos(strtolower($pseudo), $recherche) !== false) {
				 //echo "<li class=\"$sexe\">" . htmlspecialchars($pseudo) . "</li>";
				echo "<li class=\"$sexe\"><a href=\"profil.php?email=$email\">$pseudo</a></li>";
            }
        }
	?>
	</ul>
</body>

</html>