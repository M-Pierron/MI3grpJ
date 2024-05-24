<?php
$dossier='Monjambonbuerre/users';
$tablesdossiers=array_diff(scandir($dossier), array('..', '.'));;

// Fonction pour lire et extraire les informations du profil
function recupinfo($nomfichier) {
    if (($fichier = fopen($nomfichier, 'r')) !== false) {
        $ligne = fgetcsv($fichier, 0, ';');
        fclose($fichier);

        if ($ligne !== false) {
            $infos = [
			'pseudo' => $ligne[4],'sexe' => strtolower($ligne[6])];
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
	$fichier="Monjambonbuerre/users/$tablesdossiers/donnees.csv";
    $result = recupinfo($fichier);
    if ($result !== null) {
        $results[] = $result;
    } else {
        $results[] = "Le fichier n'a pas pu être ouvert.";
    }
}

// Vérifier si une recherche a été effectuée
$recherche = '';
if (isset($_GET['recherche'])) {
    $recherche = strtolower(trim($_GET['recherche']));
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="accueil.css" rel="stylesheet">
<script src="filtreaccueil.js" defer></script>
</head>
<body>
	<form method="GET" action=" ">
		<input type="text" name="recherche" placeholder="Rechercher..." />
		<input type="submit" value="Valider" />
	</form>
	<div>
    <input type="radio" name="sexe" value="all" checked="checked" /> Tous
    <input type="radio" name="sexe" value="homme"  /> Homme
    <input type="radio" name="sexe" value="femme"  /> Femme
	</div>
	<form method="GET" action=" ">
		<button type='submit' name='déconnexion'>Se déconnecter</button>
	</form>
	<ul>
	<?php
        foreach ($results as $result) {
			$pseudo = $result['pseudo'];
			$sexe = htmlspecialchars($result['sexe']);
            // Si une recherche a été effectuée, filtrer les résultats
            if ($recherche === '' || strpos(strtolower($pseudo), $recherche) !== false) {
				echo "<li class=\"$sexe\">" . htmlspecialchars($pseudo) . "</li>";
				/*echo "<li><a href="profil.php?email=<?php echo emailduprofil; ?>">
				<?php echo htmlspecialchars($result); ?></a></li>";*/
            }
        }
	?>
	</ul>
</body>

</html>
