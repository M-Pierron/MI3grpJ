<?php
session_start();
if (!isset($_SESSION["email"]) || $_SESSION["role"] !== 'admin') {
    header('Location: accueil.php');
    exit;
}

$directory = "MonJambonbeurre.fr/users/";

function getProfiles($directory) {
    $profiles = [];
    foreach (scandir($directory) as $user) {
        if ($user !== '.' && $user !== '..') {
            $profile = [
                'email' => $user,
                'data_file' => "$directory/$user/donnees"
            ];
            $profiles[] = $profile;
        }
    }
    return $profiles;
}

$profiles = getProfiles($directory);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panneau d'Administration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Panneau d'Administration</h1>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($profiles as $profile): ?>
            <tr>
                <td><?php echo htmlspecialchars($profile['email']); ?></td>
                <td>
                    <form action="editionprofil.php" method="POST">
                        <input type="hidden" name="email" value="<?php echo $profile['email']; ?>">
                        <input type="submit" value="Éditer">
                    </form>
                    <form action="suppressionprofil.php" method="POST>
                        <input type="hidden" name="email" value="<?php echo $profile['email']; ?>">
                        <input type="submit" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce profil ?');">
                    </form>
                    <form action="conversation_message.php" method="GET">
                        <input type="hidden" name="email" value="<?php echo $profile['email']; ?>">
                        <input type="submit" value="Messagerie">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
