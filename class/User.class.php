<?php
require("../prefs/credentials.php");
// Die Klasse erbt von der Superklasse PDO
class User extends PDO {

	// Konstruktormethode: Stelle die Verbindung zur DB her
    public function __construct($host,$dbname,$user,$passwd) {
    	$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname .';charset=utf8';
    	
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
		}
		catch (PDOException $e) {
			die("Verbindung zur Datenbank fehlgeschlagen: ".$e->getMessage());
		}
	}
	// Methode zum Eröffnen eines neuen Accounts
	public function createMethod($username, $passwort) {
		$query = "INSERT INTO users (username, pw) VALUES (:username, :pw)";
		$securePW = password_hash($passwort, PASSWORD_DEFAULT);
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':username', $username);
		$stmt -> bindParam(':pw', $securePW);
		$stmt -> execute();
		// Das funktioniert nur mit MySQL-Datenbanken!
		return $this -> lastInsertId();
	}
	
	// Ist vorläufig nicht in Gebrauch
	public function readMethod() {
		$query = "SELECT * FROM CRUD";
		$stmt = $this -> prepare($query);
		$stmt -> execute();
		$result = $stmt -> fetchAll();
		return $result;
	}
	
	// Checkt ob der User bereits existiert
	public function checkUserExist($username) {
		$query = "SELECT * FROM users WHERE username = :username";
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':username', $username);
		$stmt -> execute();
		$result = $stmt -> fetch();
		if($result) {
			return true;
		}
		else {
			return false;
		}
	}

		// Checkt das Login (username und passwort)
		public function checkUserLogin($username, $pw) {
			$query = "SELECT * FROM users WHERE username = :username";
			$stmt = $this -> prepare($query);
			$stmt -> bindParam(':username', $username);
			$stmt -> execute();
			$result = $stmt -> fetch();

			if($result) {
				//return true;
				// Passwort verifizieren
					if (password_verify($pw, $result['pw'])) {
						// Passwort stimmt überein
						return true;

					}
					else {
						// Passwort falsch
						return false;

					}
			}
			else {
				// User existiert nicht
				return false;
			}

		}


		// Ist vorläufig nicht in Gebrauch
	public function updateMethod($idInput, $vornameInput, $nachnameInput, $emailInput, $bemerkungenInput) {
		$query = "UPDATE CRUD SET ";
		$query .= "vorname = :vorname, ";
		$query .= "nachname = :nachname, ";
		$query .= "ort = :ort";
		$query .= "email = :email, ";
		$query .= "bemerkungen = :bemerkungen ";
		$query .= "WHERE ID = :ID ";
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':ID', $idInput, PDO::PARAM_INT);
		$stmt -> bindParam(':vorname', $vornameInput);
		$stmt -> bindParam(':nachname', $nachnameInput);
		$stmt -> bindParam(':ort', $ortInput);
		$stmt -> bindParam(':email', $emailInput);
		$stmt -> bindParam(':bemerkungen', $bemerkungenInput);
		$stmt -> execute();
	}
		// Ist vorläufig nicht in Gebrauch
	public function deleteMethod($idInput) {
		$query = "DELETE FROM CRUD WHERE ID = :ID";
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':ID', $idInput, PDO::PARAM_INT);
		$stmt -> execute();
	}
}


if(isset($_POST['username']) && isset($_POST['userCheck'])){
	$userName =$_POST['username'];
	$dbInst = new User($host,$dbname,$user,$passwd);
	$userCheck=$dbInst->checkUserExists($userName);
	header('Content-Type: application/json');
	echo json_encode($userCheck);
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['create'])){
	$userName =$_POST['username'];
	$password =$_POST['password'];
	$dbInst = new User($host,$dbname,$user,$passwd);
	$res=$dbInst->createMethod($userName,$password);
	header('Content-Type: application/json');
	echo json_encode($res);
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login'])){
	$userName =$_POST['username'];
	$password =$_POST['password'];
	$dbInst = new User($host,$dbname,$user,$passwd);
	$res=$dbInst->checkUserLogin($userName,$password);
	header('Content-Type: application/json');
	echo json_encode($res);
}

?>


