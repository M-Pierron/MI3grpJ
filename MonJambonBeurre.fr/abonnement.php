<?php
session_start();
// -- Verificateur de connexion -- 
if (!isset($_SESSION['email'])) {
    header("Location: accueil.php");
    exit;
}

$email = $_SESSION['email'];

// -- Verifie l'abonnement de l'utilisateur --
$fichier_abonnement = "users/$email/abonnement.txt";
    if (file_exists($fichier_abonnement)) {
        $date_abonnement = file_get_contents($fichier_abonnement);
        $date_expiration = date('Y-m-d', strtotime($date_abonnement . ' +1 year'));
        $date_actuelle = date('Y-m-d');
        
        if ($date_actuelle <= $date_expiration) {
            unlink('users/$email/abonnement.txt');
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Abonnement</title>
</head>
<body>
    <a href="accueil.php"> accueil </a>
    <h1>Abonnement pour <?php echo htmlspecialchars($email); ?></h1>
    <form method="POST" action="creer_abonnement.php">
        <button type="submit">ABONNEMENT 1 AN</button>
    </form>
</body>
</html>
