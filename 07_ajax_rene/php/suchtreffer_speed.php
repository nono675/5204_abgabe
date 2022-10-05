<?php
$startzeit = hrtime(true);
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


$query = "SELECT Nachname, Vorname, ID FROM Personen WHERE Nachname LIKE :nachname";
$stmt = $dbInst -> prepare($query);
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
	$result = false;
}

$endzeit = hrtime(true);
// Berechne die verstrichene Zeit ...
$zeit = $endzeit - $startzeit;
// und füge Sie als Millisekunden der Rückgabe hinzu
$result['zeit'] = ($zeit / 1000000)." Millisekunden" ;
header('Content-Type: application/json');
echo json_encode($result);
?>