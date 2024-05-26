<?php
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}

$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : null;

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

$conversations = recupererConversations($email);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Conversations</title>
</head>
<body>
    <h2>Conversations</h2>
    <ul>
        <?php foreach ($conversations as $conversation) : ?>
            <li><a href="conversation_message.php?recepteur=<?php echo htmlspecialchars($conversation); ?>"><?php echo htmlspecialchars($conversation); ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
