<?php
    session_start();
    // -- Verificateur de connexion --
    if (!isset($_SESSION["email"])) {
        header('Location: accueil.php');
        exit;
    }
    // -- Recupere la methode POST -- 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email_session = $_SESSION["email"];
        $fichier_csv = fopen("users/$email_session/donnees.csv", "r+");
        $donnees = [];

        while (($data = fgetcsv($fichier_csv, 1000, ";")) !== FALSE) {
            $donnees[] = $data;
        }
        // -- Modifie les valeurs -- 
        foreach ($donnees as &$ligne) {
            if ($ligne[0] == $email_session) { r
                $ligne[1] = $_POST["mdp"];           
                $ligne[2] = $_POST["prenom"];        
                $ligne[3] = $_POST["nom"];           
                $ligne[4] = $ligne[4];               
                $ligne[5] = $ligne[5];               
                $ligne[6] = $_POST["locaprecise"];   
                $ligne[7] = $_POST["pseudo"];        
                $ligne[8] = $_POST["profession"];    
                $ligne[9] = $_POST["loca"];          
                $ligne[10] = $_POST["situation"];    
                $ligne[11] = $_POST["description"];  
                $ligne[12] = $_POST["citation"];     n
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
