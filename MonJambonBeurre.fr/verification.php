<?php
session_start();

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password']; 

       
        $dossier = 'Monjambonbuerre/users/' . $email . '/donnees.csv';
        if (file_exists($dossier)) {
            $_SESSION['email'] = $email;
            header("Location: abonnement.php"); 
            exit;
        } else {
            $error = "L'utilisateur n'existe pas.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vérification</title>
</head>
<body>
    <h1>Veuillez entrer vos informations d'identification</h1>
    <?php if (!empty($error)) { echo "<p>$error</p>"; } ?>
    <form method="POST" action="">
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Vérifier</button>
    </form>
</body>
</html>
