<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $email = $_POST['Email'];
    $mot_de_passe = $_POST['mdp'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prénom'];
    $pseudo = $_POST['Pseudo'];
    $sexe = $_POST['Sexe'];
    $date_naissance = $_POST['date_de_naissance'];
    $lieu_residence = $_POST['Lieu'];

    $donnees = "$email; $mot_de_passe; $nom; $prenom; $pseudo; $sexe; $date_naissance; $lieu_residence\n";

    // Le fichier où les donnees sont enregistrées
    $fichier = 'donnees_inscription.txt';

    $file = fopen($fichier, 'a');

    fwrite($file, $donnees);

    fclose($file);
}
?>
