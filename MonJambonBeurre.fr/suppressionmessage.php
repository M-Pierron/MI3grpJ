<?php
session_start();
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $timestamp = htmlspecialchars($_POST['timestamp']);
    $envoyeur = htmlspecialchars($_POST['envoyeur']);
    $recepteur = htmlspecialchars($_POST['recepteur']);

    $fichier_envoyeur = "users/$envoyeur/messages/$recepteur.csv";
    $fichier_recepteur = "users/$recepteur/messages/$envoyeur.csv";

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

    supprimerMessage($fichier_envoyeur, $timestamp);
    supprimerMessage($fichier_recepteur, $timestamp);

    // Return a success response to the AJAX request
    echo "Message supprimé";
}
