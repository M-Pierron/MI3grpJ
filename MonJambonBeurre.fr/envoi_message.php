<?php
session_start();
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $recepteur = $_POST['recepteur'];
    $envoyeur = $_SESSION["email"];
    $timestamp = date('Y-m-d H:i:s');
    if (!empty($message) && !empty($recepteur)) {
        $dossier_envoyeur = "MonJambonbeurre.fr/users/$envoyeur/messages";
        if (!file_exists($dossier_envoyeur)) {
            mkdir($dossier_envoyeur, 0777, true);
        }
        $fichier_envoyeur = "$dossier_envoyeur/$recepteur.csv";
        $fp_envoyeur = fopen($fichier_envoyeur, 'a');
        fputcsv($fp_envoyeur, [$timestamp, $envoyeur, $message]);
        fclose($fp_envoyeur);
        $dossier_recepteur = "MonJambonbeurre.fr/users/$recepteur/messages";
        if (!file_exists($dossier_recepteur)) {
            mkdir($dossier_recepteur, 0777, true);
        }
        $fichier_recepteur = "$dossier_recepteur/$envoyeur.csv";
        $fp_recepteur = fopen($fichier_recepteur, 'a');
        fputcsv($fp_recepteur, [$timestamp, $envoyeur, $message]);
        fclose($fp_recepteur);
    }
}
?>
