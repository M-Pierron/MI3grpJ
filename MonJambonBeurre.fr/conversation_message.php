<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php 
require_once("fonctioncookie.php");
if (estabonnevip()) :
?>
    <div id="messagesContainer"></div>

    <form id="messageForm" method="POST">
        <textarea name="message" id="messageInput" required></textarea>
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
        <input type="hidden" name="recepteur" value="<?php echo htmlspecialchars($_POST['email-recepteur']); ?>">
        <input type="submit" value="Envoyer">
    </form>

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
            $.ajax({
                url: `recuperation_messages.php?email=${encodeURIComponent('<?php echo $_POST['email']; ?>')}&recepteur=${encodeURIComponent('<?php echo $_POST['email-recepteur']; ?>')}`,
                type: 'GET',
                success: function(response) {
                    $('#messagesContainer').html(response);
                }
            });
        }

        recupMessages();
        setInterval(recupMessages, 1000);
    </script>
<?php else : ?>
    <p>Pour débloquer cette fonctionnalité, veuillez vous abonner</p>
    <a href="boutique.php">Boutique</a>
<?php endif; ?>

</body>
</html>
