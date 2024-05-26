<?php
session_start();
if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Non autorisé");
}

$recepteur = isset($_GET['recepteur']) ? htmlspecialchars($_GET['recepteur']) : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Conversation avec <?php echo htmlspecialchars($recepteur); ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div style="float: left; width: 30%;">
        <?php include("conversations.php"); ?>
    </div>

    <div style="float: left; width: 70%;">
        <?php if ($recepteur) : ?>
            <div id="messagesContainer"></div>

            <form id="messageForm" method="POST">
                <textarea name="message" id="messageInput" required></textarea>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                <input type="hidden" name="recepteur" value="<?php echo htmlspecialchars($recepteur); ?>">
                <input type="submit" value="Envoyer">
            </form>
        <?php else : ?>
            <p>Sélectionnez une conversation dans la liste à gauche pour afficher les messages.</p>
        <?php endif; ?>
    </div>

    <script>
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

        function recupMessages() {
            var recepteur = '<?php echo $recepteur; ?>';
            if (recepteur) {
                $.ajax({
                    url: `recuperation_messages.php?email=${encodeURIComponent('<?php echo $_POST['email']; ?>')}&recepteur=${encodeURIComponent(recepteur)}`,
                    type: 'GET',
                    success: function(response) {
                        $('#messagesContainer').html(response);
                    }
                });
            }
        }

        recupMessages();
        setInterval(recupMessages, 1000);
    </script>
</body>
</html>