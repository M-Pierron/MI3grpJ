<?php
session_start();
// -- Verificateur de connexion --
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}
// -- Verification methode POST --
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = htmlspecialchars($_POST['message']);
    $recepteur = htmlspecialchars($_POST['recepteur']);
    $envoyeur = htmlspecialchars($_POST["email"]);
    $timestamp = date('Y-m-d H:i:s');
    $deleted = 0; 
    // -- Sauvegarde le message, dans les deux dossiers -- 
    if (!empty($message) && !empty($recepteur)) {
        $dossier_envoyeur = "users/$envoyeur/messages";
        if (!file_exists($dossier_envoyeur)) {
            mkdir($dossier_envoyeur, 0777, true);
        }
        $fichier_envoyeur = "$dossier_envoyeur/$recepteur.csv";
        $fp_envoyeur = fopen($fichier_envoyeur, 'a');
        fputcsv($fp_envoyeur, [$timestamp, $envoyeur, $message, $deleted]);
        fclose($fp_envoyeur);

        $dossier_recepteur = "users/$recepteur/messages";
        if (!file_exists($dossier_recepteur)) {
            mkdir($dossier_recepteur, 0777, true);
        }
        $fichier_recepteur = "$dossier_recepteur/$envoyeur.csv";
        $fp_recepteur = fopen($fichier_recepteur, 'a');
        fputcsv($fp_recepteur, [$timestamp, $envoyeur, $message, $deleted]);
        fclose($fp_recepteur);
    }
}
