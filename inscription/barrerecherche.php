<?php

$fichiers=[
	"Monjambonbuerre\users\user1@exemple.com/donnees.csv",
	"Monjambonbuerre\users\user2@exemple.com/donnees.csv",
	"Monjambonbuerre\users\user3@exemple.com/donnees.csv",
	];
// Fonction pour lire et extraire les informations du profil
function recupinfo($nomfichier) {
    if (($fichier = fopen($nomfichier, 'r')) !== false) {
        $ligne = fgetcsv($fichier, 0, ';');
        fclose($fichier);

        if ($ligne !== false) {
            $infos = array_slice($ligne, 4, 4);
            return implode(' ', $infos);
        }
    }
    return null;
}

// Parcourir les fichiers et récupérer informations à afficher
$results = [];
foreach ($fichiers as $fichier) {
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
</head>
<body>
	<form method="GET" action="">
		<input type="text" name="recherche" placeholder="Rechercher..." />
		<input type="submit" value="Valider" />
	</form>
	<ul>
	<?php
        foreach ($results as $result) {
            // Si une recherche a été effectuée, filtrer les résultats
            if ($recherche === '' || strpos(strtolower($result), $recherche) !== false) {
                echo "<li>" . htmlspecialchars($result) . "</li>";
            }
        }
        ?>	
	</ul>

</body>

</html>

