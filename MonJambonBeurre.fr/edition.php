<?php
    session_start();
    if (!isset($_SESSION["email"])) {
        header('Location: accueil.php');
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email_session = $_SESSION["email"];
        $fichier_csv = fopen("users/$email_session/donnees.csv", "r+");
        $donnees = [];

        while (($data = fgetcsv($fichier_csv, 1000, ";")) !== FALSE) {
            $donnees[] = $data;
        }

        foreach ($donnees as &$ligne) {
            if ($ligne[0] == $email_session) { // Ensure we are updating the correct user
                $ligne[1] = $_POST["mdp"];           // mot de passe
                $ligne[2] = $_POST["prenom"];        // prénom
                $ligne[3] = $_POST["nom"];           // nom
                $ligne[4] = $ligne[4];               // sexe (not modifiable)
                $ligne[5] = $ligne[5];               // age (not modifiable)
                $ligne[6] = $_POST["locaprecise"];   // localisation précise
                $ligne[7] = $_POST["pseudo"];        // pseudo
                $ligne[8] = $_POST["profession"];    // profession
                $ligne[9] = $_POST["loca"];          // localisation
                $ligne[10] = $_POST["situation"];    // situation
                $ligne[11] = $_POST["description"];  // description
                $ligne[12] = $_POST["citation"];     // citation
                break;
            }
        }

        rewind($fichier_csv);

        foreach ($donnees as $ligne) {
            fputcsv($fichier_csv, $ligne, ";");
        }

        fclose($fichier_csv);
    }

    header("Location: monprofil.php");
    exit;
?>