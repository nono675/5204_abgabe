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
	
// Method to create a new account
	public function createMethod($username,$password) {
		$query = "INSERT INTO login (username, pw) VALUES (:username, :pw )";
		$securePW= password_hash($password,PASSWORD_DEFAULT);
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':username', $username);
		$stmt -> bindParam(':pw', $securePW);
		$stmt -> execute();
		// Das funktioniert nur mit MySQL-Datenbanken!
		return $this -> lastInsertId();
	}
// not used	
	public function readMethod() {
		$query = "SELECT * FROM CRUD";
		$stmt = $this -> prepare($query);
		$stmt -> execute();
		$result = $stmt -> fetchAll();
		return $result;
	}
// Method to check if a user already exists
	public function checkUserExists($username) {
		$query = "SELECT * FROM login WHERE username = :username";
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':username', $username);
		$stmt -> execute();
		$result = $stmt -> fetch();
		if ($result) {
			//user exists
			return true;
		}else{
			//user doesnt exists
			return false;
		}
	}	
// Method for Login check	
	public function checkUserLogin($username,$password) {
		$query = "SELECT * FROM login WHERE username = :username";
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':username', $username);
		$stmt -> execute();
		$result = $stmt -> fetch();
		if ($result) {
// Password Verify
		if(password_verify($password, $result['pw'])){
// password correct
			return true;
		}else{
//password false
			return false;
		}
	}
}
// not used		
	public function updateMethod($idInput, $vornameInput, $nachnameInput, $emailInput, $ortInput, $bemerkungenInput) {
		$query = "UPDATE CRUD SET ";
		$query .= "vorname = :vorname, ";
		$query .= "nachname = :nachname, ";
		$query .= "email = :email, ";
		$query .= "ort = :ort, ";
		$query .= "bemerkungen = :bemerkungen ";
		$query .= "WHERE ID = :ID ";
		$stmt = $this -> prepare($query);
		$stmt -> bindParam(':ID', $idInput, PDO::PARAM_INT);
		$stmt -> bindParam(':vorname', $vornameInput);
		$stmt -> bindParam(':nachname', $nachnameInput);
		$stmt -> bindParam(':email', $emailInput);
		$stmt -> bindParam(':ort', $ortInput);
		$stmt -> bindParam(':bemerkungen', $bemerkungenInput);
		$stmt -> execute();
	}
// not used		
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