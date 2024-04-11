<!DOCTYPE html> 
<html> 
	<head>
		<link rel="stylesheet" type="text/css" href=".css">
		<script type="text/javascript"src=".js"></script>
	</head>
	<body>
        <table>
            <tr>
                <td>
                    Adresse mail
                </td>
                <td>
                    <?php 
						
                         echo $_SESSION["Adresse_mail"];
                    ?>

                </td>
            </tr>
            <tr>
                <td>
                    Mode de passe
                </td>
                <td>
                     <?php 
					 
                         echo $_SESSION["Mot_de_passe"];
                    ?>
                </td>
            </tr>
			
			<tr>
                <td>
                    Prenom
                </td>
                <td>
                     <?php 
					 
                         echo $_SESSION["Prenom"];
                    ?>
                </td>
            </tr>
			
			<tr>
                <td>
                    Nom
                </td>
                <td>
                     <?php 
					 
                         echo $_SESSION["Nom"];
                    ?>
                </td>
            </tr>
			
            <tr>
                <td>
                    Pseudo 
                </td>
                <td>
                     <?php 
					 
                         echo $_SESSION["Pseudo"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    Age
                </td>
                <td>
                     <?php 
					 
                         echo $_SESSION["Age"];
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    Sexe
                </td>
                <td>
                    <?php 
					
                         echo $_SESSION["Sexe"];
                    ?>
                </td>
            </tr>

            <tr>
                <td>
                    Taille
                </td>
                <td>
                    <?php 
					
                         echo $_SESSION["Taille"];
                    ?>
                </td>
            </tr>

            <tr>
                <td>
                    Poids
                </td>
                <td>
                     <?php 
					 
                         echo $_SESSION["Poids"];
                    ?>
                </td>
            </tr>

            <tr>
                <td>
                    Centre d'interet
                </td>
                <td>
                     <?php 
					 
                         echo $_SESSION["Centre_d_interet"];
                    ?>
                </td>
            </tr>
        </table>
		<a href=profileedition.php> <img src="editing.jpg" alt="image"/> </a>
		
	</body> 
</html>



