<?php
// -- Effectue l'inscription sur la base de données -- 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['Email'];
    $mot_de_passe = $_POST['mdp'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $sexe = $_POST['Sexe'];
    $date_naissance = $_POST['date_de_naissance'];
    $adresse = $_POST['Adresse'];
    $pseudo = $_POST['Pseudo'];
    $profession = $_POST['Profession'];
    $lieu = $_POST['Lieu'];
    $situation = $_POST['Situation'];
    $physique = $_POST['Physique'];
    $info = $_POST['Infos_Perso'];
    $date_inscription = date('Y-m-d');
    $donnees = "$email; $mot_de_passe; $nom; $prenom; $sexe; $date_naissance; $adresse; $pseudo; $profession; $lieu; $situation; $physique; $info; $date_inscription\n";

   // -- Creer le dossier correspondant --
    if (!is_dir('users/'.$email)){
        mkdir('users/'.$email);
        mkdir('users/'.$email.'/photos');
    }
    else{
        header("Location: inscription.html");
        exit;
    }

      
    $fichier = 'users/'.$email.'/donnees.csv';
    
    
    $file = fopen($fichier, 'a');
    fwrite($file, $donnees);
    fclose($file);

   // -- Effectue les images -- 
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = 'users/'.$email . '/photos/' . $fileName;

            
            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                echo "Le fichier $fileName a été téléchargé avec succès.<br>";
            } else {
                echo "Erreur lors du téléchargement du fichier $fileName.<br>";
            }
        }
    } else {
        echo 'Aucun fichier téléchargé.';
    }
    
    header("Location: connexion.html");
    exit;
}
?>
