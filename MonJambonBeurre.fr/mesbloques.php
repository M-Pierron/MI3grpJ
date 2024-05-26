<?php
session_start();
// -- Verificateur de connexion --
if (!$_SESSION["email"]) {
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
    if (($key = array_search($email_a_debloquer, $bloques)) !== false) {
        unset($bloques[$key]);
        $fp = fopen($fichier_bloque, "w");
        foreach ($bloques as $email_bloque) {
            fputcsv($fp, [$email_bloque, 0], ";");
        }
        fclose($fp);
        header('Location: mesbloques.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
