<?php
session_start();
if (!isset($_SESSION['email'])) {
    header(Location: "choix.html");
    exit;
}

$email = $_SESSION['email'];
$dossier='users';
$tablesdossiers=array_diff(scandir($dossier), array('..', '.'));;

// Fonction pour lire et extraire les informations du profil
function recupinfo($nomfichier) {
    if (($fichier = fopen($nomfichier, 'r')) !== false) {
        $ligne = fgetcsv($fichier, 0, ';');
        fclose($fichier);

        if ($ligne !== false) {
            $infos = [
			'pseudo' => $ligne[7],'sexe' => strtolower($ligne[4]),'mail' =>$ligne[0]];
            return  $infos;
			
        }
    }
    return null;
}

// Parcourir les fichiers et récupérer informations à afficher

$results = [];
foreach ($tablesdossiers as $tablesdossiers) {
	//$sousdossier=$tablesdossiers;
	$fichier="users/$tablesdossiers/donnees.csv";
    $result = recupinfo($fichier);
    if ($result !== null) {
        $results[] = $result;
    } else {
        $results[] = "Le fichier n'a pas pu être ouvert.";
    }
}

// Vérifier si une recherche a été effectuée
$recherche = '';
if (isset($_POST['recherche'])) {
    $recherche = strtolower(trim($_POST['recherche']));
}
// vérifie si l'utilisateur est abonné
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$is_abonne = false;

$fichier_abonnement = "users/$email/abonnement.txt";
if (file_exists($fichier_abonnement))		{
	$is_abonne = true;
	$date_abonnement = file_get_contents($fichier_abonnement);
	$date_expiration = date('Y-m-d', strtotime($date_abonnement . ' +1 year'));
	$date_actuelle = date('Y-m-d');
	if ($date_actuelle <= $date_expiration) {
		$is_abonne = false;
	}
}

//vérifie si administrateur 
$fichier_admin="users/$email/admin.csv";
$est_admin=FALSE;
if (file_exists($fichier_admin)){
	$est_admin=TRUE;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="CSS/accueil.css?v=1.1" rel="stylesheet">
<script src="JS/filtreaccueil.js" defer></script>
</head>
<body>
    <header>
        <nav>
            <h1>Trouvez l'amour</h1>
        </nav>
    </header>

    <div class="div2">
        <div class="left-buttons">
            <form method="POST" action="conversation_message.php">
                <button type="submit" id="msg">Mes messages</button>
                <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
            </form>
            <form method="POST" action="monprofil.php">
                <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                <button type="submit">Mon profil</button>
            </form>
        </div>
        <div class="right-button">
            <form method="POST" action="traitement_deconnexion.php">
                <button type="submit" id="deco">Déconnexion<img src="../image/croix.png" width="17" height="17"></button>
            </form>
        </div>
        <?php if ($est_admin): ?>
            <form method="POST" action="panel_admin.php">
                <button type="submit" id="adm" value="administrateur">Admin</button>
            </form>
        <?php endif; ?>
    </div>
    
    <div class="div1">
        <form method="POST" action="">
            <input type="text" name="recherche" placeholder="Rechercher..." />
            <button type="submit" class="search-icon"></button>
        </form>
        
        <div class="filters">
            <input type="radio" name="sexe" value="all" checked="checked" /> Tous
            <input type="radio" name="sexe" value="homme" /> Homme
            <input type="radio" name="sexe" value="femme" /> Femme
        </div>
    </div>

    <?php
    require_once('fonction_abonnee.php');
    if (!(est_abonnee($email))): ?>
        <div class="subscription-banner">
            <form method="POST" action="abonnement.php">
                <button type="submit">ABONNEZ-VOUS</button>
            </form>
        </div>
    <?php endif; ?>

    <ul>
    <?php
    foreach ($results as $result) {
        $pseudo = htmlspecialchars($result['pseudo']);
        $sexe = htmlspecialchars($result['sexe']);
        $email = htmlspecialchars($result['mail']);
        require_once('fonctionbloquer.php');
        if ($email !== $_SESSION['email'] && !(est_bloquer($_SESSION['email'],$email))) {
            if ($recherche === '' || strpos(strtolower($pseudo), $recherche) !== false) {
                echo "<li class='$sexe'><a href='profil.php?email=$email'>$pseudo</a></li>";
            }
        }
    }
    ?>
    </ul>
</body>
</html>


