<?php
// MAN BEACHTE DEN PFAD!!!
// der gilt jetzt ab dem PHP-Dokument selber
require("../prefs/credentials.php");
$username = filter_var($_POST['user'], FILTER_SANITIZE_STRING);

// PDO OHNE eigene Subklasse
$dsn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname .';charset=utf8';
// Array für Optionen für PDO anlegen
$options = array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
   
try {
	$dbInst = new PDO($dsn, $dbuser, $dbpasswd, $options);
}
catch (PDOException $e) {
	// Das könnte man noch besser lösen
	die("Verbindung zur Datenbank fehlgeschlagen: ".$e->getMessage());
}


$query = "SELECT username FROM login WHERE username = :username";
$stmt = $dbInst -> prepare($query);
$stmt -> bindParam(':username', $username);
$stmt -> execute();
$result = $stmt -> fetch();
if ($result)  {
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