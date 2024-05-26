<?php
session_start();
// -- Verification de connexion --
if (!isset($_SESSION["email"])) {
    header('Location: accueil.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/style2.css">
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Profil Utilisateur</h1>
            <table>
                <?php
                    // -- Affichage du profil --
                    require_once("fonctionprofil.php");
                    affichage($_SESSION["email"], false, true);
                ?>
            </table>
            <! -- Boutons de fonctionnalités -->
            <form action="desactivationprofil.php" method="post">
                <input type="submit" value="Desactiver le profil">
            </form>
            <form action="suppressionprofil.php" method="post">
                <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                <input type="submit" value="Supprimer le profil">
            </form>
            <a href="mesbloques.php">Bloqués</a>
            <a href="mesvusdeprofil.php">Vus de profil</a>
            <form action="editionprofil.php" method="post">
                <input type="hidden" name="email_session" value="<?php echo $_SESSION['email']; ?>">
                <input type="image" src="image/editing.jpg" alt="Modifier le profil">
            </form>
            <a href="accueil.php">Accueil</a>
        </div>
    </body>
</html>
