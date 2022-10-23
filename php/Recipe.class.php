<?php
session_start([
	'cookie_lifetime' => 3600, // Set lifetime to all Session cookies to one hour (in seconds)
]);
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
	public function createMethod($rezeptname, $shape, $fk_user)
	{
		$query = "INSERT INTO recipe (title, form, fk_user) VALUES (:rezeptname, :form, :fk_user)";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':rezeptname', $rezeptname);
		$stmt->bindParam(':form', $shape);
		$stmt->bindParam(':fk_user', $fk_user);
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
	public function updateRezeptMethod($rezeptId, $rezeptname, $shape)
	{
		$query = "UPDATE recipe 
		Set title = :rezeptname, form = :form
		where id = :rezeptId";

		$stmt = $this->prepare($query);
		$stmt->bindParam(':rezeptname', $rezeptname);
		$stmt->bindParam(':rezeptId', $rezeptId);
		$stmt->bindParam(':form', $shape);
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
		$query = "SELECT recipe.id, recipe.title, recipe.fk_user FROM recipe";
		$stmt = $this->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	// Read methode mit join a zutaten_zu_rezept. Gibt pro Zutat eine Zeile zurück (ein Rezept taucht mehrmahls auf)
	public function readAllRecipeJoinedMethod($search)
	{
		if ($search !== null) {
			$search = "%$search%";
		}

		$query = "SELECT recipe.id as rezept_id, recipe.title, recipe.form,
		recipe.fk_user, zutaten_zu_rezept.id, zutaten_zu_rezept.zutaten_name, zutaten_zu_rezept.fk_rezepte FROM recipe
		JOIN zutaten_zu_rezept ON zutaten_zu_rezept.fk_rezepte = recipe.id
		WHERE recipe.id in (
			SELECT recipe.id as rezept_id FROM recipe
			JOIN zutaten_zu_rezept ON zutaten_zu_rezept.fk_rezepte = recipe.id
			WHERE :search is null or recipe.title like :search or zutaten_zu_rezept.zutaten_name like :search
		)";

		$stmt = $this->prepare($query);
		$stmt->bindParam(':search', $search);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	// Read methode mit join a zutaten_zu_rezept. Gibt pro Zutat eine Zeile zurück (ein Rezept taucht mehrmahls auf)
	public function readAllRecipeJoinedPerUserMethod($fk_user)
	{
		$query = "SELECT recipe.id as rezept_id, recipe.title, recipe.form, recipe.fk_user, zutaten_zu_rezept.id, zutaten_zu_rezept.zutaten_name, zutaten_zu_rezept.fk_rezepte FROM recipe
		JOIN zutaten_zu_rezept ON zutaten_zu_rezept.fk_rezepte = recipe.id
		Where fk_user = :fk_user";
		$stmt = $this->prepare($query);
		$stmt->bindParam(':fk_user', $fk_user);
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
		$query = "DELETE FROM recipe WHERE id = :ID";
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

	// Check if Session exists
	if (!isset($_SESSION['fk_user'])) {
		header("HTTP/1.1 401 Unauthorized");
		exit;
	}

	$rezept = new Recipe($host, $dbname, $user, $passwd);

	$existingRezeptId = $_POST['id'];

	$rezept->deleteZutatenVonRezeptMethod($existingRezeptId);

	$rezeptname = $_POST['recipe-title'];
	$shape = $_POST['answer'];
	$rezept->updateRezeptMethod($existingRezeptId, $rezeptname, $shape);

	////****** This is an example of how you can return any custom json. */
	// $result['id'] = $id;
	// echo json_encode($result);
	///******* end example.*/
	if (isset($_POST['checkbox'])) {
		foreach ($_POST['checkbox'] as $value) {
			$rezept->createZutatenMethod($value, $existingRezeptId);
		}
	}
	if (isset($_POST['oil']) && $_POST['oil'] != 'Wähle eine Option') {
		$value = $_POST['oil'];
		$rezept->createZutatenMethod($value, $existingRezeptId);
	}
	if (isset($_POST['superfood']) && $_POST['superfood'] != 'Wähle eine Option') {
		$value = $_POST['superfood'];
		$rezept->createZutatenMethod($value, $existingRezeptId);
	}
	$result['edit'] = "edit";
	$result['answer'] = $shape;
	echo json_encode($result);
	exit;
}

// Create form submit (only new recipes.)
if (!isset($_GET['calculateBasicAmounts']) && !isset($_GET['calculateAddOnsAmounts']) && !isset($_POST['id']) && isset($_POST['recipe-title'])) { // it's necessary to check isset($_POST['recipe-title']

	// Check if Session exists
	if (!isset($_SESSION['fk_user'])) {
		header("HTTP/1.1 401 Unauthorized");
		exit;
	}

	$rezept = new Recipe($host, $dbname, $user, $passwd);

	$rezeptname = $_POST['recipe-title'];
	$shape = $_POST['answer'];
	$id = $rezept->createMethod($rezeptname, $shape, $_SESSION['fk_user']);

	////****** This is an example of how you can return any custom json. */
	// $result['add'] = "add";
	// echo json_encode($result);
	///******* end example.*/
	if (isset($_POST['checkbox'])) {
		foreach ($_POST['checkbox'] as $value) {
			$rezept->createZutatenMethod($value, $id);
		}
	}

	if (isset($_POST['oil']) && $_POST['oil'] != 'Wähle eine Option') {
		$value = $_POST['oil'];
		$rezept->createZutatenMethod($value, $id);
	}
	if (isset($_POST['superfood']) && $_POST['superfood'] != 'Wähle eine Option') {
		$value = $_POST['superfood'];
		$rezept->createZutatenMethod($value, $id);
	}

	$result['add'] = "add";
	echo json_encode($result);
	exit;
}

// Calculates the grams per basic Zutat.
if (isset($_GET['calculateBasicAmounts'])) {

	$rezept = new Recipe($host, $dbname, $user, $passwd);

	// Defines all possible Basic Zutaten names
	$basicZutaten = array("Dinkelmehl", "Kartoffelmehl", "Vollkornmehl", "Buchweizenmehl", "Weizenmehl", "Kichererbsenmehl");

	// New Array to fill with all set Basic CheckBoxes provcied in the form
	$basicCheckBoxesInForm = array();

	if (isset($_POST['checkbox'])) {
		// Go through each checkbox of the submitted form (all checkboxes are sent)
		foreach ($_POST['checkbox'] as $checkBoxName) {
			// if in_array returns true, this mean the checkBoxName of the loop is in $basicZutaten and then we can add it to $basicCheckBoxesInForm
			if (in_array($checkBoxName, $basicZutaten)) {
				$basicCheckBoxesInForm[] = $checkBoxName;
			}
		}
		if (count($basicCheckBoxesInForm) > 0) {
			// Devide the total weigt (200g) of basic zutaten by the number of set basic Zutaten in form
			$gramsPerBasic = floor(200 / count($basicCheckBoxesInForm));

			// Go through all set Basic Zutaten CheckBoxes in Form and attach it to the json result with the calculated grams
			foreach ($basicCheckBoxesInForm as $basicCheckBoxName) {
				$result[$basicCheckBoxName] = $gramsPerBasic;
			}
		}
		$result['calcBasic'] = "calcBasic";
		echo json_encode($result);
	} else {
		echo json_encode(null);
	}
	exit;
}

// Calculates the grams per Add-On Zutat.
if (isset($_GET['calculateAddOnsAmounts'])) {
	$rezept = new Recipe($host, $dbname, $user, $passwd);

	// Defines all possible Add-On Zutaten names
	$addOnZutaten = array(
		"Leber", "Hackfleisch", "Schweineschmalz", "Gekochter Schinken",
		"Hüttenkäse", "Parmesan", "Cheddar", "Sardinen", "Thunfisch", "Lachsfilet"
	);

	// New Array to fill with all set Add-On CheckBoxes provcied in the form
	$addOnCheckBoxNamesInForm = array();

	if (isset($_POST['checkbox'])) {
		// Go through each checkbox of the submitted form (all checkboxes are sent)
		foreach ($_POST['checkbox'] as $checkBoxName) {
			// if in_array returns true, this mean the checkBoxName of the loop is in $addOnZutaten and then we can add it to $addOnCheckBoxNamesInForm
			if (in_array($checkBoxName, $addOnZutaten)) {
				$addOnCheckBoxNamesInForm[] = $checkBoxName;
			}
		}

		if (count($addOnCheckBoxNamesInForm) > 0) {
			// Devide the total weigt (200g) of all Add-On zutaten by the number of set Add-On Zutaten in form
			$gramsPerMeat = floor(200 / count($addOnCheckBoxNamesInForm));

			// Go through all set Add-On  Zutaten CheckBoxes in Form and attach it to the json result with the calculated grams
			foreach ($addOnCheckBoxNamesInForm as $meatCheckBoxName) {
				$result[$meatCheckBoxName] = $gramsPerMeat;
			}
		}
		$result['calcAdd-On'] = "calcAdd-On";
		echo json_encode($result);
	} else {
		echo json_encode(null);
	}
	exit;
}

// Deletes a Recipe and all according Zutaten
if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'DELETE') {

	// Check if Session exists
	if (!isset($_SESSION['fk_user'])) {
		header("HTTP/1.1 401 Unauthorized");
		exit;
	}

	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$dbInst->deleteZutatenVonRezeptMethod($_GET['id']);
	$dbInst->deleteMethod($_GET['id']);
	$result['Id'] = $_GET['id'];
	$result['Delete'] = "Delete";
	header('Content-Type: application/json');
	echo json_encode($result);
	exit;
}

// if you call fetch('php/Recipe.class.php?getall')
if (isset($_GET['getall'])) {
	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$res = $dbInst->readAllRecipeMethod();
	header('Content-Type: application/json');
	echo json_encode($res);
	exit;
}

// if you call fetch('php/Recipe.class.php?getalljoined')
if (isset($_GET['getalljoined'])) {
	$search = null;
	if (isset($_GET['search'])) {
		$search = $_GET['search'];
	}

	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$res = $dbInst->readAllRecipeJoinedMethod($search);
	header('Content-Type: application/json');
	echo json_encode($res);
	exit;
}

// if you call fetch('php/Recipe.class.php?getAllJoinedForUser')
if (isset($_GET['getAllJoinedForUser'])) {
	// Check if Session exists
	if (!isset($_SESSION['fk_user'])) {
		header("HTTP/1.1 401 Unauthorized");
		exit;
	}
	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$res = $dbInst->readAllRecipeJoinedPerUserMethod($_SESSION['fk_user']);
	header('Content-Type: application/json');
	echo json_encode($res);
	exit;
}

// if you call fetch('php/Recipe.class.php?getZutatenProRezept&id=')
if (isset($_GET['getZutatenProRezept']) and isset($_GET['id'])) {
	$dbInst = new Recipe($host, $dbname, $user, $passwd);
	$res = $dbInst->readAllZutatenZuRezeptProRezeptMethod($_GET['id']);
	header('Content-Type: application/json');
	echo json_encode($res);
	exit;
}

// If request fullfills no conditions return 404 Not Found
header("HTTP/1.1 404 Not Found");
exit;
