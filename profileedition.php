<!DOCTYPE html> 
<html> 
<head>
    <link rel="stylesheet" type="text/css" href=".css">
    <script type="text/javascript" src=".js"></script>
</head>
<body>
    <?php
    if (isset($_SESSION["ID"])) {
        $fichier_csv = fopen("donnees.csv", "r");
        $id_session = $_SESSION["ID"];
        $trouve = false;
        while (($data = fgetcsv($fichier_csv, 1000, ";")) !== FALSE && !$trouve) {
            if ($data[0] == $id_session) {
                $trouve = true;
                ?>
                <form action="editing.php" method="post">
                    <label for="email"> Email : </label>
                    <input type="text" id="email" name="email" value="<?php echo $data[1]; ?>"/>
                    <br>
                    <label for="mdp"> Mot de passe : </label>
                    <input type="text" id="mdp" name="mdp" value="<?php echo $data[2]; ?>">
                    <br>
                    <label for="prenom"> Prenom : </label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo $data[4]; ?>"/>
                    <br>
                    <label for="nom"> Nom : </label>
                    <input type="text" id="nom" name="nom" value="<?php echo $data[3]; ?>">
                    <br>
                    <label for="pseudo"> Pseudo : </label>
                    <input type="text" id="pseudo" name="pseudo" value="<?php echo $data[5]; ?>"/>
                    <br>
                    <label for="age"> Age : </label>
                    <input type="text" id="age" name="age" value="<?php echo $data[6]; ?>">
                    <br>
                    <label for="sexe"> Sexe : </label>
                    <input type="text" id="sexe" name="sexe" value="<?php echo $data[7]; ?>">
                    <br>
                    <label for="taille"> Taille : </label>
                    <input type="text" id="taille" name="taille" value="<?php echo $data[8]; ?>"/>
                    <br>
                    <label for="poids"> Poids : </label>
                    <input type="text" id="poids" name="poids" value="<?php echo $data[9]; ?>"/>
                    <br>
                    <label for="centreinteret"> Centre d'interet : </label>
                    <input type="text" id="centreinteret" name="centreinteret" value="<?php echo $data[10]; ?>"/>
                    <br>
                    <input type="submit" value="Enregistrer">
                </form>
                <?php
            }
        }
        fclose($fichier_csv);
    }
	?>
    <a href=profile.php> <img src="retour.jpg" alt="image"/> </a>
</body> 
</html>
