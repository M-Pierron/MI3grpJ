<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $email = $_POST['Email'];
    $mot_de_passe = $_POST['mdp'];


    // Vérifie si le dossier de l'utilisateur existe
    if (is_dir($email)) {
        // Chemin vers le fichier de données
        $fichier_donnees = $email . '/donnees_inscription.txt';

        // Vérifie si le fichier de données existe
        if (file_exists($fichier_donnees)) {
            // Lit le fichier de données
            $contenu = file_get_contents($fichier_donnees);

            // Transforme le contenu du fichier en tableau
            $donnees = explode('; ', $contenu);

            // Vérifie les identifiants
            if (trim($donnees[0]) == $email && trim($donnees[1]) == $mot_de_passe) {
                echo "Connexion réussie !";
                // Redirige ou effectue d'autres actions
                // header("Location: page_protegee.php");
                // exit;
            } else {
                echo "Identifiants incorrects.";
            }
        } else {
            echo "Fichier de données introuvable.";
        }
    } else {
        echo "Dossier utilisateur introuvable.";
    }
}
?>
