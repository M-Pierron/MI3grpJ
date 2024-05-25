<?php 
function estabonnevip() {
	return ((isset($_COOKIE['abonne']) && $_COOKIE['abonne'] === 'true') || (isset($_COOKIE['VIP']) && $_COOKIE['VIP'] === 'true'));
}

function estabonne() {
	return (isset($_COOKIE['abonne']) && $_COOKIE['abonne'] === 'true');
}

?>