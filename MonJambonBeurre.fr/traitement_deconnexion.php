<?php
// -- Deconnexion, fermeture de la session --
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
	header("Location: choix.html");
}
?>
