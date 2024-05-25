<?php
session_start();
if (!$_SESSION["email"]) {
    header('Location: accueil.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email_a_bloquer'])) {
    $email_session = $_SESSION["email"];
    $email_bloque = $_POST["email_a_bloquer"];
    $fichier_bloque = "MonJambonbeurre.fr/users/$email_session/bloque";
    
    $bloques = [];
    if (file_exists($fichier_bloque)) {
        $fp = fopen($fichier_bloque, "r");
        while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
            $bloques[] = $data;
        }
        fclose($fp);
    }
    
    $trouve = false;
    foreach ($bloques as &$bloque) {
        if ($bloque[0] == $email_bloque) {
            $bloque[1] = 1;
            $trouve = true;
            break;
        }
    }
    if (!$trouve) {
        $bloques[] = [$email_bloque, 1];
    }
    
    $fp = fopen($fichier_bloque, "w");
    foreach ($bloques as $bloque) {
        fputcsv($fp, $bloque, ";");
    }
    fclose($fp);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
    <table>
        <?php
        $email_a_afficher = $_GET["email"];
        require_once("fonctionprofil.php");
        affichage($email_a_afficher, false, false);
		$email_session = $_SESSION["email"];
		require_once("fonctionvu.php");
		vudeprofil($email_a_afficher, $email_session);
        ?>
		
    </table>
    <form action="conversation_message.php" method="post">
		<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
        <input type="submit" value="Envoyer un message">
    </form>
    <form action="profil.php?email=<?php echo htmlspecialchars($email_a_afficher); ?>" method="post">
        <input type="hidden" name="email_a_bloquer" value="<?php echo htmlspecialchars($email_a_afficher); ?>">
        <input type="submit" value="Bloquer l'utilisateur">
    </form>
</body>
</html>
