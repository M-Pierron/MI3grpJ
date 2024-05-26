<?php
session_start();
if (!isset($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
}

$email_session = $_SESSION["email"];
$fichier_bloque = "users/$email_session/bloque";
$bloques = [];

if (file_exists($fichier_bloque)) {
    $fp = fopen($fichier_bloque, "r");
    while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
        if ($data[1] == 1) {
            $bloques[] = $data[0];
        }
    }
    fclose($fp);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_a_debloquer = $_POST['email_a_debloquer'];
    $donnees = [];
    if (file_exists($fichier_bloque)) {
        $fp = fopen($fichier_bloque, "r");
        while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
            $donnees[] = $data;
        }
        fclose($fp);
    }
    foreach ($donnees as &$ligne) {
        if ($ligne[0] == $email_a_debloquer) {
            $ligne[1] = 0;
            break;
        }
    }
    $fp_temp = fopen("$fichier_bloque.tmp", "w");
    foreach ($donnees as $ligne) {
        fputcsv($fp_temp, $ligne, ";");
    }
    fclose($fp_temp);
    rename("$fichier_bloque.tmp", $fichier_bloque);
    header('Location: mesbloques.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs bloqués</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Liste des utilisateurs bloqués</h1>
    <?php if (empty($bloques)) : ?>
        <p>Aucun utilisateur bloqué.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($bloques as $email_bloque) : ?>
                <li>
                    <?php echo htmlspecialchars($email_bloque); ?>
                    <form action="mesbloques.php" method="post" style="display:inline;">
                        <input type="hidden" name="email_a_debloquer" value="<?php echo htmlspecialchars($email_bloque); ?>">
                        <input type="submit" value="Débloquer">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="monprofil.php">Retour au profil</a>
</body>
</html>
