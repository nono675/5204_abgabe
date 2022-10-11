<?php
require("../prefs/credentials.php");
// Die Klasse erbt von der Superklasse PDO
class Recipe extends PDO
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
	// Methode zum Erstellen eines neuen Rezepts
	public function createMethod($rezeptname)
	{
		$query = "INSERT INTO recipe (title) VALUES (:rezeptname)";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':rezeptname', $rezeptname);
		$stmt->execute();
		// Das funktioniert nur mit MySQL-Datenbanken!
		return $this->lastInsertId();
	}

	// Methode zum Erstellen einer Zutat
	public function createZutatenMethod($zutaten_name, $fk_rezepte)
	{
		$query = "INSERT INTO zutaten_zu_rezept (zutaten_name, fk_rezepte) VALUES (:zutaten_name, :fk_rezepte)";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':zutaten_name', $zutaten_name);
		$stmt->bindParam(':fk_rezepte', $fk_rezepte);
		$stmt->execute();
		// Das funktioniert nur mit MySQL-Datenbanken!
		return $this->lastInsertId();
	}

	// Methode zum Updated eines Rezepts
	public function updateRezeptMethod($rezeptId, $rezeptname)
	{
		$query = "UPDATE recipe 
		Set title = :rezeptname
		where id = :rezeptId";

		$stmt = $this->prepare($query);
		$stmt->bindParam(':rezeptname', $rezeptname);
		$stmt->bindParam(':rezeptId', $rezeptId);
		$stmt->execute();
		// Das funktioniert nur mit MySQL-Datenbanken!
		return $this->lastInsertId();
	}

	// Read methode von zutaten_zu_rezept pro Rezept
	public function readAllZutatenZuRezeptProRezeptMethod($rezept_id)
	{
		$query = "SELECT zutaten_zu_rezept.id, zutaten_zu_rezept.zutaten_name, zutaten_zu_rezept.fk_rezepte FROM zutaten_zu_rezept
		WHERE fk_rezepte = {$rezept_id}";
		$stmt = $this->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	// Read methode von recipe ohne join zu zutaten_zu_rezept
	public function readAllRecipeMethod()
	{
		$query = "SELECT recipe.id, recipe.title, recipe.beschreib, recipe.image, recipe.fk_user FROM recipe";
		$stmt = $this->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	// Read methode mit join a zutaten_zu_rezept. Gibt pro Zutat eine Zeile zurück (ein Rezept taucht mehrmahls auf)
	public function readAllRecipeJoinedMethod()
	{
		$query = "SELECT recipe.id as rezept_id, recipe.title, recipe.beschreib, recipe.image, recipe.fk_user, zutaten_zu_rezept.id, zutaten_zu_rezept.zutaten_name, zutaten_zu_rezept.fk_rezepte FROM recipe
		JOIN zutaten_zu_rezept ON zutaten_zu_rezept.fk_rezepte = recipe.id";
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

	// Löscht alle Zutaten von einem Rezept (nötig für das Löschen oder Update eines Rezept)
	public function deleteZutatenVonRezeptMethod($idRezept)
	{
		$query = "DELETE FROM zutaten_zu_rezept WHERE fk_rezepte = :RezeptId";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':RezeptId', $idRezept, PDO::PARAM_INT);
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

	public function getSingleRecord($idInput)
	{
		$query = "SELECT * FROM recipe WHERE ID = :ID";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':ID', $idInput, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
}

// Update form submit.
if (isset($_POST['id']) && isset($_POST['recipe-title'])) {
	$rezept = new Recipe($host, $dbname, $user, $passwd);
	
	$existingRezeptId = $_POST['id'];

	$rezept->deleteZutatenVonRezeptMethod($existingRezeptId);

	$rezeptname = $_POST['recipe-title'];
	$id = $rezept->updateRezeptMethod($existingRezeptId, $rezeptname);

	////****** This is an example of how you can return any custom json. */
	// $result['id'] = $id;
	// echo json_encode($result);
	///******* end example.*/

	foreach ($_POST['checkbox'] as $value) {

		$rezept->createZutatenMethod($value, $existingRezeptId);
	}
	$result['edit'] = "edit";
	echo json_encode($result);
}

// Create form submit (only new recipes.)
if (!isset($_POST['id']) && isset($_POST['recipe-title'])) { // it's necessary to check isset($_POST['recipe-title']
	$rezept = new Recipe($host, $dbname, $user, $passwd);
	
	$rezeptname = $_POST['recipe-title'];
	$id = $rezept->createMethod($rezeptname);

	////****** This is an example of how you can return any custom json. */
	// $result['add'] = "add";
	// echo json_encode($result);
	///******* end example.*/

	foreach ($_POST['checkbox'] as $value) {
		$rezept->createZutatenMethod($value, $id);
	}
	$result['add'] = "add";
	echo json_encode($result);
}

// if you call fetch('php/Recipe.class.php?getall')
if (isset($_GET['getall'])) {
	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$res = $dbInst->readAllRecipeMethod();
	header('Content-Type: application/json');
	echo json_encode($res);
}

// if you call fetch('php/Recipe.class.php?getalljoined')
if (isset($_GET['getalljoined'])) {
	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$res = $dbInst->readAllRecipeJoinedMethod();
	header('Content-Type: application/json');
	echo json_encode($res);
}

// if you call fetch('php/Recipe.class.php?getZutatenProRezept&id=')
if (isset($_GET['getZutatenProRezept']) and isset($_GET['id'])) {
	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$res = $dbInst->readAllZutatenZuRezeptProRezeptMethod($_GET['id']);
	header('Content-Type: application/json');
	echo json_encode($res);
}
