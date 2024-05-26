<?php
// -- Verifie si la personne est bloqué ou a bloqué l'utilisateur --
function est_bloquer($monemail, $sonemail) {
    $monfichier_bloque = "users/$monemail/bloque";
    $sonfichier_bloque =  "users/$sonemail/bloque";
    if (file_exists($monfichier_bloque)) {
        if (($fp = fopen($monfichier_bloque, "r")) !== false) {
            while (($data = fgetcsv($fp, 1000, ";")) !== false) {
                if ($sonemail == $data[0] && $data[1] == 1) {
                    fclose($fp);
                    return true;
                }
            }
            fclose($fp);
        }
	}		
    if (file_exists($sonfichier_bloque)) {
        if (($fp = fopen($sonfichier_bloque, "r")) !== false) {
            while (($data = fgetcsv($fp, 1000, ";")) !== false) {
                if ($monemail == $data[0] && $data[1] == 1) {
                    fclose($fp);
                    return true;
                }
            }
            fclose($fp);
		}
	}
    return false;
}
?>
