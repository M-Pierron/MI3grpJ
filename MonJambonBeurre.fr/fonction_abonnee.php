<?php
// -- Verifie l'abonnement de la personne -- 
function est_abonnee($email){
	$est_abonne = false;
	$fichier_abonnement = "users/$email/abonnement.txt";
	if (file_exists($fichier_abonnement))		{
		$est_abonne = true;
		$date_abonnement = file_get_contents($fichier_abonnement);
		$date_expiration = date('Y-m-d', strtotime($date_abonnement . ' +1 year'));
		$date_actuelle = date('Y-m-d');
		if ($date_actuelle <= $date_expiration) {
			$est_abonne = false;
		}
	}
	return $est_abonne;
}
// -- Verifie le sexe de la personne -- 
function est_femme($email) {
	$nomfichier="users/$email/donnees.csv";
    if (($fichier = fopen($nomfichier, 'r')) !== false) {
        $ligne = fgetcsv($fichier, 0, ';');
        fclose($fichier);
        $sexe = $ligne[4];
        return $sexe === ' Femme';
    }
	return false ;
}
?>
