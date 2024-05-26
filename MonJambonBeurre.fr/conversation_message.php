<?php

// -- Verificateur de connexion --
session_start();
if (!isset($_SESSION["email"])) {
	hearder('Location: accueil.php'); 
}

// -- Recupere le recepteur avec la methode get --
$recepteur = isset($_GET['recepteur']) ? htmlspecialchars($_GET['recepteur']) : null;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="CSS/style3.css">
	<title>Conversation avec <?php echo htmlspecialchars($recepteur); ?></title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<! -- Sur la partie gauche de la page, affiche les discussions -->
    <div style="float: left; width: 30%;">
        <?php include("conversations.php"); ?>
    </div>
<! -- Sur le reste, affiche la discussion en elle même -->
    <div style="float: left; width: 70%;">
        <?php if ($recepteur) : ?>
	// -- Zone de message --
            <div id="messagesContainer"></div>
            <form id="messageForm" method="POST">
                <textarea name="message" id="messageInput" required></textarea>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">
                <input type="hidden" name="recepteur" value="<?php echo htmlspecialchars($recepteur); ?>">
                <input type="submit" value="Envoyer">
            </form>
        <?php else : ?>
            <p>Sélectionnez une conversation dans la liste à gauche pour afficher les messages.</p>
        <?php endif; ?>
    </div>
	<! -- AJAX pour la messagerie instantanée -->
    <script>
        $(document).ready(function() {
		// -- Recupere les messages dynamiquement --
            function recupMessages() {
                var recepteur = '<?php echo $recepteur; ?>';
                if (recepteur) {
                    $.ajax({
                        url: `recuperation_messages.php?email=${encodeURIComponent('<?php echo $_SESSION['email']; ?>')}&recepteur=${encodeURIComponent(recepteur)}`,
                        type: 'GET',
                        success: function(response) {
                            $('#messagesContainer').html(response);
                        }
                    });
                }
            }
		// -- Envoie les messages dynamiquement -- 
            $('#messageForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'envoi_message.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#messageInput').val('');
                        recupMessages();
                    }
                });
            });

            recupMessages();
		// -- Choix arbitraire de 1 seconde --
            setInterval(recupMessages, 1000);
		// -- Verification de supression --
            $(document).on('submit', '.deleteMessageForm', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'suppressionmessage.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        recupMessages();
                    }
                });
            });
        });
    </script>
	
	<a href="accueil.php"> accueil </a>
</body>
</html>
