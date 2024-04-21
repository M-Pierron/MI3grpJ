<?php
// Fonction pour rechercher les profils dans le fichier texte
function searchProfiles($searchKeyword) {
    // Le chemin du fichier où les données sont enregistrées
    $fichier = 'donnees_inscription.txt';

    // Ouvrez le fichier en mode lecture
    $file = fopen($fichier, 'r');

    // Tableau pour stocker les résultats de recherche
    $searchResults = array();

    // Parcourez chaque ligne du fichier
    while (!feof($file)) {
        $ligne = fgets($file); // Lisez une ligne

        // Divisez la ligne en utilisant le délimiteur ';' pour obtenir les différents champs
        $profil = explode(';', $ligne);

        // Vérifiez si le profil correspond au mot-clé de recherche
        foreach ($profil as $champ) {
            if (strpos($champ, $searchKeyword) !== false) {
                // Si le profil correspond, ajoutez-le au tableau des résultats
                $searchResults[] = $profil;
                break; // Passez au profil suivant
            }
        }
    }

    // Fermez le fichier
    fclose($file);

    // Renvoyez les résultats de recherche
    return $searchResults;
}

// Si le formulaire de recherche est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez le mot-clé de recherche depuis le formulaire
    $searchKeyword = $_POST['searchKeyword'];

    // Effectuez la recherche des profils
    $results = searchProfiles($searchKeyword);

    // Affichez les résultats de recherche
    foreach ($results as $profil) {
        echo implode(' | ', $profil) . '<br>'; // Affichez chaque profil, séparé par un trait vertical (' | ')
    }
}
?>