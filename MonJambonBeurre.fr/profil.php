<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
}

// Vérifier si la méthode de requête est POST et si l'e-mail à bloquer est défini
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email_a_bloquer'])) {
    $email_session = $_SESSION["email"];
    $email_bloque = $_POST["email_a_bloquer"];
    $fichier_bloque = "users/$email_session/bloque";

    // Vérifier si le répertoire de blocage existe, sinon le créer
    if (!file_exists(dirname($fichier_bloque))) {
        mkdir(dirname($fichier_bloque), 0777, true);
    }

    // Ouvrir le fichier de blocage en lecture/écriture
    $fp = fopen($fichier_bloque, "a+");
    if ($fp === false) {
        // Erreur lors de l'ouverture du fichier
        echo "Une erreur est survenue lors de l'ouverture du fichier de blocage.";
        exit;
    }

    // Vérifier si l'e-mail à bloquer est déjà dans la liste des blocages
    $trouve = false;
    while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
        if ($data[0] == $email_bloque) {
            $data[1] = 1; // Mettre à jour l'état du blocage
            $trouve = true;
            break;
        }
    }
    if (!$trouve) {
        // Ajouter l'e-mail à bloquer à la liste
        fputcsv($fp, [$email_bloque, 1], ";");
    }

    // Fermer le fichier
    fclose($fp);

    // Rediriger l'utilisateur après le blocage
    header('Location: accueil.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/style2.css">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
    <table>
        <?php
$email_a_afficher = $_GET["email"];
if ($email_a_afficher == $_SESSION['email']) {
header('Location: monprofil.php');
exit;
}
        require_once("fonctionprofil.php");
        affichage($email_a_afficher, false, false);
$email_session = $_SESSION["email"];
require_once("fonctionvu.php");
vuduprofil($email_a_afficher, $email_session);
        ?>

    </table>
    <form action="conversation_message.php?recepteur=<?php echo htmlspecialchars($email_a_afficher); ?>" method="post">
<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
        <input type="submit" value="Envoyer un message">
    </form>
    <form action="profil.php" method="post">
        <input type="hidden" name="email_a_bloquer" value="<?php echo htmlspecialchars($email_a_afficher); ?>">
        <input type="submit" value="Bloquer l'utilisateur">
    </form>
<a href="accueil.php">accueil</a>

</body>
</html>