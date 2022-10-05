<?php
// Desinfektion der Eingabe
$regexValue = $_POST['password'];
// Setze hier deinen Code ein:
$search= '/^(?=[^\d_].*?\d)\w(\w|[!@#$%]){7,20}$/';
if (preg_match($search, $regexValue)) {
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