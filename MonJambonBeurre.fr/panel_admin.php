<?php
// -- Verification de connexion --
session_start();
if (!isset($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
}

$directory = "users";
// -- Va chercher les profils, pour faire un tableau -- 
function getProfiles($directory) {
    $profiles = [];
    foreach (scandir($directory) as $user) {
        if ($user !== '.' && $user !== '..') {
            $profile = [
                'email' => $user,
                'data_file' => "$directory/$user/donnees.csv"
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
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="CSS/style4.css">
    <title>Panneau d'Administration</title>
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
			<! -- Affiche les profils avec les fonctionnalités admin -->
                    <form action="editionprofil.php" method="POST">
                        <input type="hidden" name="email_session" value="<?php echo $profile['email']; ?>">
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
