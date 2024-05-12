<?php
// Vérifier si le formulaire de connexion est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les identifiants d'utilisateur depuis le formulaire soumis
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];

    // Lire les utilisateurs depuis le fichier texte
    $utilisateurs = file("utilisateurs.txt", FILE_IGNORE_NEW_LINES);
    // Lire les mots de passe depuis le fichier texte
    $mots_de_passe = file("mots_de_passe.txt", FILE_IGNORE_NEW_LINES);

    // Vérifier si l'utilisateur existe dans la liste des utilisateurs
    $index = array_search($nom, $utilisateurs);
    if ($index !== false && isset($mots_de_passe[$index])) {
        // Vérifier si le mot de passe correspond
        if ($mots_de_passe[$index] == $mdp) {
            // Authentification réussie, définir le cookie d'utilisateur
            $module = "abonné"; 
            setcookie('uti_type', $module, time() + (86400 * 30), "/"); // Cookie valide pendant 30 jours 
            header("Location: page_d'accueil.php"); // Rediriger vers la page d'accueil après connexion
            exit();
        } else {
            echo "Mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        echo "Utilisateur non trouvé. Veuillez réessayer.";
    }
}

// Vérifier si l'utilisateur est déjà authentifié
if(isset($_COOKIE['uti_type'])) {
    $user_type = $_COOKIE['uti_type'];
    if($user_type == 'abonné') {
        echo "Bienvenue, abonné!";
        // Ici tu peux afficher des fonctionnalités spécifiques aux abonnés
    } elseif($user_type == 'admin') {
        echo "Bienvenue, administrateur!";
        // Ici tu peux afficher des fonctionnalités spécifiques aux administrateurs
    } else {
        echo "";
        // Ici tu peux afficher le contenu pour les visiteurs non authentifiés
    }
} else {
    echo "Bienvenue, visiteur!";
    // Ici tu peux afficher le contenu pour les visiteurs non authentifiés
}
?>