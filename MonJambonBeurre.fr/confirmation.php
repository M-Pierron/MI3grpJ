<?php
session_start();
// -- Verificateur de connexion --
if (!isset($_SESSION['message'])) {
    header("Location: accueil.php");
    exit;
}

$message = $_SESSION['message'];
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
</head>
<body>
    <h1>Confirmation d'abonnement</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
    <a href="accueil.php">Retour à l'accueil</a>
</body>
</html>
