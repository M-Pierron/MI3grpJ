<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
</head>
<body>
    <?php
    // Vérifier si l'utilisateur a cliqué sur le bouton d'abonnement
    if(isset($_POST['subscribe'])) {
        // Créer un cookie d'abonnement valide pendant 30 jours
        setcookie('abonne', 'true', time() + (30 * 24 * 60 * 60), '/');
        
        // Rediriger l'utilisateur vers la page principale
        header("Location: testcookie2.php");
        exit;
    }

    // Vérifier si l'utilisateur est déjà abonné ou si ses 30 jours d'abonnement sont encore valides
    $abonne = isset($_COOKIE['abonne']) && $_COOKIE['abonne'] === 'true';
    $abonnementExpire = isset($_COOKIE['abonnement_expire']) && $_COOKIE['abonnement_expire'] > time();
    ?>

    <form method='post'>
        <?php
        // Si l'utilisateur est abonné et son abonnement est toujours valide, afficher le message
        if ($abonne && $abonnementExpire) {
            echo "<p>Vous êtes abonné !</p>";
        } else {
            // Sinon, afficher le bouton d'abonnement
            echo "<button type='submit' name='subscribe'>S'abonner</button>";
        }
        ?>
    </form>

    <div align="center">
        <img src="cathesev.jpg" alt="cathedral" />
    </div>
</body>
</html>