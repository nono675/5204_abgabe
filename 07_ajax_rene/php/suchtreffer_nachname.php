<?php
// MAN BEACHTE DEN PFAD!!!
// der gilt jetzt ab dem PHP-Dokument selber
require("../prefs/credentials.php");
//$nachname = filter_var($_POST['nachname'], FILTER_SANITIZE_STRING);
$nachname = $_POST['nachname'];

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

// Das LIKE-Schlüsselwort braucht man, um mit einem Suchmuster zu suchen
$query = "SELECT Nachname, Vorname, ID FROM Personen WHERE Nachname LIKE :nachname";
$stmt = $dbInst -> prepare($query);
// Der Suchstring erhält eine Wildcard, in MySql ist das ein Prozentzeichen
// % steht für null, eins oder mehrere Zeichen
$nachnameWildcard = $nachname."%";
$stmt -> bindParam(':nachname', $nachnameWildcard);
$stmt -> execute();
$result = $stmt -> fetchAll();
if ($result)  {
	// ja
	$resultReturn = $result;
	}
else {
	// nein
	$resultReturn = false;
}
header('Content-Type: application/json');
echo json_encode($resultReturn);
?>