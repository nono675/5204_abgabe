<?php
// Desinfektion der Eingabe
$emailValue = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
// Ist die E-Mail-Adresse gültig?
if (filter_var($emailValue, FILTER_VALIDATE_EMAIL)) {
	// ja
	$check = true;
	}
else {
	// nein
	$check = false;
}
header('Content-Type: application/json');
echo json_encode($check);
?>