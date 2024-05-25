if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_session = $_SESSION["email"];
    $email_bloque = $_GET["email"];
    $fichier_bloque = "MonJambonbeurre.fr/users/$email_session/bloque";
    $fp = fopen($fichier_bloque, "r");
    $bloques = [];
    while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
        $bloques[] = $data;
    }
    fclose($fp);
    $trouve = false;
    foreach ($bloques as &$bloque) {
        if ($bloque[0] == $email_bloque) {
            $bloque[1] = 1;
            $trouve = true;
            break;
        }
    }