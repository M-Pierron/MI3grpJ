<?php
session_start();
// -- Verifie la connexion --
if (!isset($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
}
// -- Si ils sont bloqués, ou non abonnés, les rediriges --
require_once('fonctionbloquer.php');
require_once('fonction_abonnee.php');
if (est_bloquer($_SESSION["email"], $_GET["email"]) || !(est_abonne($_SESSION["email"]) || !(est_femme($_SESSION["email"]) {
    header('Location: accueil.php');
    exit;
    }
// -- Verifie la methode POST --
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $timestamp = htmlspecialchars($_POST['timestamp']);
    $envoyeur = htmlspecialchars($_POST['envoyeur']);
    $recepteur = htmlspecialchars($_POST['recepteur']);

    $fichier_envoyeur = "users/$envoyeur/messages/$recepteur.csv";
    $fichier_recepteur = "users/$recepteur/messages/$envoyeur.csv";
// -- Supprime le message --
    function supprimerMessage($fichier, $timestamp) {
        if (file_exists($fichier)) {
            $temp_file = tempnam('.', 'tmp');
            $input = fopen($fichier, 'r');
            $output = fopen($temp_file, 'w');

            while (($data = fgetcsv($input)) !== FALSE) {
                if ($data[0] == $timestamp) {
                    $data[3] = 1; 
                }
                fputcsv($output, $data);
            }

            fclose($input);
            fclose($output);

            unlink($fichier);
            rename($temp_file, $fichier);
        }
    }
// -- Supprime dans les deux dossiers -- 
    supprimerMessage($fichier_envoyeur, $timestamp);
    supprimerMessage($fichier_recepteur, $timestamp);

   
    echo "Message supprimé";
}
