<?php
// -- Verification de connexion --
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}
// -- Si ils sont bloqués, ou non abonnés, les rediriges --
require_once('fonctionbloquer.php');
require_once('fonction_abonnee.php');
if (est_bloquer($_SESSION["email"], $_GET["email"]) || !(est_abonne($_SESSION["email"]) || !(est_femme($_SESSION["email"]) {
    header('Location: accueil.php');
    exit;
    }
											     
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : null;
// -- Recupere les conversations deja existantes -- 
function recupererConversations($email) {
    $dossier_utilisateur = "users/$email/messages";
    $conversations = [];

    if (is_dir($dossier_utilisateur)) {
        $fichiers = scandir($dossier_utilisateur);
        foreach ($fichiers as $fichier) {
            if ($fichier !== '.' && $fichier !== '..' && is_file("$dossier_utilisateur/$fichier")) {
                $conversations[] = basename($fichier, ".csv");
            }
        }
    }

    return $conversations;
}
// -- Stock les résultats --
$conversations = recupererConversations($email);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="CSS/style3.css">
    <title>Conversations</title>
</head>
<body>
    <h2>Conversations</h2>
    <ul>
	    <! -- Affiche les discussions -->
        <?php foreach ($conversations as $conversation) : ?>
            <li><a href="conversation_message.php?recepteur=<?php echo htmlspecialchars($conversation); ?>"><?php echo htmlspecialchars($conversation); ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
