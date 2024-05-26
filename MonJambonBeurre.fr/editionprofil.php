<?php 
session_start();
// -- Verificateur de connexion --
if(!$_SESSION["email"]){
    header('Location: accueil.php');
    exit;
}
$email_session = $_POST['email_session'];
?>

<!DOCTYPE html> 
<html> 
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/style2.css"> 
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Édition du Profil</h1>
            <form action="edition.php" method="post">
                <table>
                    <?php
                        // -- Affichage des champs à potentiellement modifier --
                        require_once("fonctionprofil.php"); 
                        affichage($email_session, true, true);  
                    ?>
                </table>
                <input type="hidden" name="email_session" value="<?php echo $email_session; ?>">
                <input type="submit" value="Sauvegarder">
            </form>
            <a href="accueil.php"> <img src="image/retour.jpg" alt="Retour" /> </a>
        </div>
    </body> 
</html>
