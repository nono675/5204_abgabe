<?php
session_start([
	'cookie_lifetime' => 3600, // Set lifetime to all Session cookies to one hour (in seconds)
]);
require("../prefs/credentials.php");
// Die Klasse erbt von der Superklasse PDO
class User extends PDO
{

	// Konstruktormethode: Stelle die Verbindung zur DB her
	public function __construct($host, $dbname, $user, $passwd)
	{
		$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8';

		// Array für Optionen für PDO anlegen
		$options = array(
			// Wir wollen in der Testphase wissen, ob es Fehler gibt.
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			// Mit dieser Option werden die Resultate in Form von assoziativen Arrays retour kommen.
			// In den meisten Fällen ist das der effizienteste Weg, die Resultate in HTML auszugeben ...
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		try {
			// Konstruktor der PDO-Klasse (Superklasse) aufrufen
			parent::__construct($dsn, $user, $passwd, $options);
		} catch (PDOException $e) {
			die("Verbindung zur Datenbank fehlgeschlagen: " . $e->getMessage());
		}
	}
	// Methode zum Eröffnen eines neuen Accounts
	public function createMethod($vorname, $nachname, $username, $passwort)
	{
		$query = "INSERT INTO users (vorname, nachname, username, pw) VALUES (:vorname, :nachname, :username, :pw)";
		$securePW = password_hash($passwort, PASSWORD_DEFAULT);
		$stmt = $this->prepare($query);
		$stmt->bindParam(':vorname', $vorname);
		$stmt->bindParam(':nachname', $nachname);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':pw', $securePW);
		$stmt->execute();
		// Das funktioniert nur mit MySQL-Datenbanken!
		return $this->lastInsertId();
	}

	// Ist vorläufig nicht in Gebrauch
	public function readMethod()
	{
		$query = "SELECT * FROM users";
		$stmt = $this->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	// Checkt ob der User bereits existiert
	public function checkUserExist($username)
	{
		$query = "SELECT * FROM users WHERE username = :username";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetch();
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	// Checkt das Login (username und passwort)
	public function checkUserLogin($username, $pw)
	{
		$query = "SELECT * FROM users WHERE username = :username";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetch();

		if ($result) {
			//return true;
			// Passwort verifizieren
			if (password_verify($pw, $result['pw'])) {
				// Passwort stimmt überein
				$_SESSION['fk_user'] = $result['id'];
				$_SESSION['username'] = $result['username'];
				return true;
			} else {
				// Passwort falsch
				setcookie(session_id(), "", time() - 3600);
				session_destroy();
				return false;
			}
		} else {
			// User existiert nicht
			setcookie(session_id(), "", time() - 3600);
			session_destroy();
			return false;
		}
	}


	// Ist vorläufig nicht in Gebrauch
	public function updateMethod($idInput, $vornameInput, $nachnameInput, $emailInput, $bemerkungenInput)
	{
		$query = "UPDATE CRUD SET ";
		$query .= "vorname = :vorname, ";
		$query .= "nachname = :nachname, ";
		$query .= "ort = :ort";
		$query .= "email = :email, ";
		$query .= "bemerkungen = :bemerkungen ";
		$query .= "WHERE ID = :ID ";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':ID', $idInput, PDO::PARAM_INT);
		$stmt->bindParam(':vorname', $vornameInput);
		$stmt->bindParam(':nachname', $nachnameInput);
		$stmt->bindParam(':ort', $ortInput);
		$stmt->bindParam(':email', $emailInput);
		$stmt->bindParam(':bemerkungen', $bemerkungenInput);
		$stmt->execute();
	}
	// Ist vorläufig nicht in Gebrauch
	public function deleteMethod($idInput)
	{
		$query = "DELETE FROM CRUD WHERE ID = :ID";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':ID', $idInput, PDO::PARAM_INT);
		$stmt->execute();
	}
}

if (isset($_GET['getSessionInfo'])) {
	if (isset($_SESSION['fk_user']) && $_SESSION['fk_user'] != "") {
		$result['fk_user'] = $_SESSION['fk_user'];
	} else {
		$result['fk_user'] = null;
	}

	header('Content-Type: application/json');
	echo json_encode($result);
	exit;
}

if (isset($_GET['logout'])) {
	setcookie(session_id(), "", time() - 3600);
	session_destroy();
	$result['logout'] = true;
	header('Content-Type: application/json');
	echo json_encode($result);
	die;
}

if (isset($_POST['username']) && isset($_POST['userCheck'])) {
	$userName = $_POST['username'];
	$dbInst = new User($host, $dbname, $user, $passwd);
	$userCheck = $dbInst->checkUserExist($userName);
	header('Content-Type: application/json');
	echo json_encode($userCheck);
	exit;
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['create'])) {
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$userName = $_POST['username'];
	$password = $_POST['password'];
	$dbInst = new User($host, $dbname, $user, $passwd);
	$res = $dbInst->createMethod($vorname, $nachname, $userName, $password);
	header('Content-Type: application/json');
	echo json_encode($res);
	exit;
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login'])) {
	$userName = $_POST['username'];
	$password = $_POST['password'];
	$dbInst = new User($host, $dbname, $user, $passwd);
	$res = $dbInst->checkUserLogin($userName, $password);
	header('Content-Type: application/json');
	echo json_encode($res);
	exit;
}


// If request fullfills no conditions return 404 Not Found
header("HTTP/1.1 404 Not Found");
exit;
