<?php
require("prefs/credentials.php");
require("class/Zutaten.class.php");
require("class/Recipe.class.php");

/* session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
  header('Location: ./login.php');
} */

$zutaten = new Zutaten($host,$dbname,$user,$passwd);
$rezept = new Recipe($host,$dbname, $user, $passwd);

var_dump(session_status());

if(isset($_POST['go'])) {

  $rezeptname = $_POST['title'];
  var_dump($rezeptname);
  $id = $rezept->createMethod($rezeptname);
  var_dump($id);

  if(!empty(isset($_POST['checkbox']))) {    
    foreach($_POST['checkbox'] as $value){
        echo "value : ".$value.'<br/>';
        $zutaten->createMethod($value, $id);
    }
  }
}
else {
  $rezeptname = "";
}




?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Free Bulma template</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="../css/register.css"> -->
  </head>
  <body>
<form class="recipe-form" method="POST" action="private.php">
<div class="field">
  <label class="label">Rezept-Name</label>
  <div class="control">
    <input class="input" type="text" name="title" placeholder="Text input">
  </div>
</div>
<div class="field">
<label class="checkbox label">Basis</label>
<div class="checkbox-container">
<div class="ingredient">
  <input type="checkbox" name="checkbox[]" id="Dinkelmehl" value="Dinkelmehl">
  Dinkelmehl
</div>
<div class="ingredient">
  <input type="checkbox" name="checkbox[]" value="Kartoffelmehl" id="Kartoffelmehl">
  Kartoffelmehl
</div>
<div class="ingredient" >
  <input type="checkbox" name="checkbox[]" value="Vollkornmehl">
  Vollkornmehl
</div>
<div class="ingredient">
  <input type="checkbox"  name="checkbox[]" value="Buchweizenmehl">
  Buchweizenmehl
</div>
<div class="ingredient">
  <input type="checkbox"  name="checkbox[]" value="Weizenmehl">
  Weizenmehl
</div>
<div class="ingredient" >
  <input type="checkbox" name="checkbox[]" value="Kichererbsenmehl">
  Kichererbsenmehl
</div>
  </div>
</div>
<div class="field">
<label class="checkbox label">Geschmackszugabe</label>
<div class="ingredients field">
  <div class="ingredient-container">
    <h3>Fleisch</h3>
    <div class="ingredient" >
      <input type="checkbox" name="Leber checkbox">
      Leber
    </div>
    <div class="ingredient">
      <input type="checkbox" name="Hackfleisch">
      Hackfleisch
    </div>
    <div class="ingredient">
      <input type="checkbox" name="Schweineschmalz">
      Schweineschmalz
    </div>
    <div class="ingredient">
      <input type="checkbox" name="Schinken">
      Gekochter Schinken
    </div>
  </div>
  <div class="ingredient-container">
    <h3>Käse</h3>
    <div class="ingredient" >
      <input type="checkbox" name="Hüttenkäse">
      Hüttenkäse
    </div>
    <div class="ingredient">
      <input type="checkbox" name="Parmesan">
      Parmesan
    </div>
    <div class="ingredient">
      <input type="checkbox"  name="Cheddar">
      Cheddar
    </div>
  </div>
  <div class="ingredient-container">
    <h3>Fisch</h3>
    <div class="ingredient">
      <input type="checkbox" name="Sardinen">
      Sardinen
    </div>
    <div class="ingredient">
      <input type="checkbox" name="Thunfisch">
      Thunfisch
    </div>
    <div class="ingredient">
      <input type="checkbox" name="Lachsfilet">
      Lachsfilet
    </div>
  </div>
</div>
</div>
<div class="select-container">
  <div class="field">
    <label class="label">Öl</label>
    <div class="control">
      <div class="select">
        <select>
          <option>Wähle eine Option</option>
          <option>Kokosöl</option>
          <option>Hanföl</option>
          <option>Olivenöl</option>
        </select>
      </div>
    </div>
  </div>
  <div class="field">
    <label class="label">Superfood</label>
    <div class="control">
      <div class="select">
        <select>
          <option>Wähle eine Option</option>
          <option>getrocknete Kamillenblüten</option>
          <option>Mariendistel-Samen</option>
          <option>Seealgenmehl</option>
          <option>Flohsamen</option>
          <option>Rosenblüten</option>
          <option>Schafgarben</option>
        </select>
      </div>
    </div>
  </div>
</div>

<div class="field">
  <label class="label">Form</label>
<div class="control radio-container">
  <label class="radio">
    <input type="radio" name="answer">
    Knochen
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Fisch
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Stern
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Halbkugel
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Herz
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Donut
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Pfoten
  </label>
</div>
</div>
<div class="field">
<div class="file">
  <h3>Lade hier ein Foto deines Haustiers hoch!</h3>
  <label class="file-label">
    <input class="file-input" type="file" name="resume">
    <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Choose a file…
      </span>
    </span>
  </label>
</div>
</div>


<div class="field">
  <div class="control">
    <label class="checkbox">
      <input type="checkbox">
      Ich bin damit einverstanden, dass mein Rezept gespeichert und veröffentlicht wird. <a href="#">terms and conditions</a>
    </label>
  </div>
</div>

<div class="field is-grouped">
  <div class="control">
    <button class="button is-block is-primary" type="submit" name="go" id="go">Absenden</button>
  </div>
  <div class="control">
    <button class="button is-link is-light">Cancel</button>
  </div>
</div>
</form>
</body>
</html>