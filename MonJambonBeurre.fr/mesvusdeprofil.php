<?php
session_start();
// -- Verificateur de connexion --
if (!$_SESSION["email"]) {
    header('Location: accueil.php');
    exit;
}
// -- Si ils sont bloqués, ou non abonnés, les rediriges --
/*require_once('fonctionbloquer.php');
require_once('fonction_abonnee.php');
if (est_bloquer($_SESSION["email"], $_GET["email"]) || !(est_abonne($_SESSION["email"]) || est_femme($_SESSION["email"]))) {
    header('Location: accueil.php');
    exit;
}*/

$email_session = $_SESSION["email"];
$fichier_log = "MonJambonbeurre.fr/users/$email_session/log_vu";

$emails_vus = [];
// -- Stock les vues de profil dans un tableau -- 
if (file_exists($fichier_log)) {
    $emails_vus = file($fichier_log, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Liste des utilisateurs ayant vu votre profil</title>
</head>
<body>
	<?php require_once("fonctioncookie.php");
	if (estabonne()) :?>
		<h1>Liste des utilisateurs ayant vu votre profil</h1>
		<?php if (empty($emails_vus)) : ?>
			<p>Aucun utilisateur n'a vu votre profil.</p>
		<?php else : ?>
			<ul>
				<?php foreach ($emails_vus as $email_vu) : ?>
					<! -- Affiche les profils -->
					<li><?php echo htmlspecialchars($email_vu); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<?php else : ?>
		<p> Pour débloquer cette fonctionnalité, veuillez vous abonner </p>
		<a href="boutique.php"> Boutique </a>
	<?php endif; ?>
</body>
</html>

