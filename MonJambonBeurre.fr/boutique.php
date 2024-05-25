<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
</head>
<body>
    <?php
    if (isset($_POST['s_abonner'])) {
        if (isset($_COOKIE['abonne_expire'])) {
            $expiration = $_COOKIE['abonne_expire'] + (30 * 24 * 60 * 60);
        } else {
            $expiration = time() + (30 * 24 * 60 * 60);
        }

        setcookie('abonne', 'true', $expiration, '/');
        setcookie('abonne_expire', $expiration, $expiration, '/');
        
        header("Location: boutique.php");
        exit;
    }

    $abonne = isset($_COOKIE['abonne']) && $_COOKIE['abonne'] === 'true';
    ?>

    <form method='post'>
        <?php
        if ($abonne) {
            echo "<p>Vous êtes abonné jusqu'au " . date('d/m/Y H:i:s', $_COOKIE['abonne_expire']) . ".</p>";
            echo "<button type='submit' name='s_abonner'>Prolonger l'abonnement</button>";
        } else {
            echo "<button type='submit' name='s_abonner'>S'abonner</button>";
        }
        ?>
    </form>
</body>
</html>
