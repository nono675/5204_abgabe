<?php
// MAN BEACHTE DEN PFAD!!!
// der gilt jetzt ab dem PHP-Dokument selber
require("../prefs/credentials.php");

$id = $_POST['id'];
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
	die("Verbindung zur Datenbank fehlgeschlagen: ".$e->getMessage());
}


$query = "SELECT * FROM Personen WHERE ID = :id";
$stmt = $dbInst -> prepare($query);
$stmt -> bindParam(':id', $id, PDO::PARAM_INT);
$stmt -> execute();
$result = $stmt -> fetch();
if ($result)  {
	// ja
	$resultReturn = $result;
	}
else {
	// nein
	$result = false;
}
header('Content-Type: application/json');
echo json_encode($result);
?>