<?php
function searchProfiles($searchKeyword) {

    $fichier = 'donnees_inscription.txt';
    $file = fopen($fichier, 'r');
    $searchResults = array();

    while (!feof($file)) {
        $ligne = fgets($file);
        $profil = explode(';', $ligne);
        foreach ($profil as $champ) {
            if (strpos($champ, $searchKeyword) !== false) {
                $searchResults[] = $profil;
                break;
            }
        }
    }
    fclose($file);
    return $searchResults;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchKeyword = $_POST['searchKeyword'];

    $results = searchProfiles($searchKeyword);
    foreach ($results as $profil) {
        echo implode(' | ', $profil) . '<br>';
    }
}
?>