<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rezept-Generator | Monty's Tidbits</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="css/recipe-postits.css">
  <link rel="stylesheet" href="css/accordion.css">
  <link rel="stylesheet" href="css/private2.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- JS -->
  <script defer src="js/addEventListenerFunctions.js"></script>
  <script defer src="js/functions.js"></script>
  <script defer src="js/main.js"></script>
  <script defer src="js/navbar.js"></script>
  <script defer src="js/showRecipes.js"></script>
  <script defer src="js/updateForm.js"></script>
</head>

<body style="display:none;"> <!-- display:none is needed to hide page until check of existing session is done -->
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a href="index.php"><i class="fa-solid fa-sharpe fa-bone"></i></a>
        <h2>Monty's Tidbits</h2>
      </div>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a href="index.php" class="button is-primary sign_up">
              <strong>Home</strong>
            </a>
            <a class="button is-light" onclick="logoutUserWithButton()">
              Log Out
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>



  <div class="user"></div>



  <div class="new-recipe">

    <form id="create-recipe-form" class="recipe-form" method="POST">
      <div class="field">
        <h2>Rezeptname</h2>
        <div class="control">
          <input id="recipe-title" class="input" type="text" name="recipe-title" placeholder="Dein Rezeptname">
        </div>
      </div>
      <div class="field">
        <h2>Basis</h2>
        <div class="checkbox-container">
          <div class="ingredient">
            <input type="checkbox" name="checkbox[]" class="basic" id="Dinkelmehl" value="Dinkelmehl">
            Dinkelmehl
          </div>
          <div class="ingredient">
            <input type="checkbox" name="checkbox[]" class="basic" value="Kartoffelmehl" id="Kartoffelmehl">
            Kartoffelmehl
          </div>
          <div class="ingredient">
            <input type="checkbox" name="checkbox[]" class="basic" value="Vollkornmehl">
            Vollkornmehl
          </div>
          <div class="ingredient">
            <input type="checkbox" name="checkbox[]" class="basic" value="Buchweizenmehl">
            Buchweizenmehl
          </div>
          <div class="ingredient">
            <input type="checkbox" name="checkbox[]" class="basic" value="Weizenmehl">
            Weizenmehl
          </div>
          <div class="ingredient">
            <input type="checkbox" name="checkbox[]" class="basic" value="Kichererbsenmehl">
            Kichererbsenmehl
          </div>
        </div>
      </div>
      <div class="field">
        <h2>Geschmackszugabe</h2>
        <div class="ingredients field">
          <div class="ingredient-container">
            <h3>Fleisch</h3>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="meat" value="Leber">
              Leber
            </div>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="meat" value="Hackfleisch">
              Hackfleisch
            </div>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="meat" value="Schweineschmalz">
              Schweineschmalz
            </div>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="meat" value="Gekochter Schinken">
              Gekochter Schinken
            </div>
          </div>
          <div class="ingredient-container">
            <h3>Käse</h3>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="cheese" value="Hüttenkäse">
              Hüttenkäse
            </div>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="cheese" value="Parmesan">
              Parmesan
            </div>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="cheese" value="Cheddar">
              Cheddar
            </div>
          </div>
          <div class="ingredient-container">
            <h3>Fisch</h3>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="fish" value="Sardinen">
              Sardinen
            </div>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="fish" value="Thunfisch">
              Thunfisch
            </div>
            <div class="ingredient">
              <input type="checkbox" name="checkbox[]" class="fish" value="Lachsfilet">
              Lachsfilet
            </div>
          </div>
        </div>
      </div>
      <div class="select-container">
        <div class="field">
          <h2><label for="oil" class="label title">Öl</label></h2>
          <div class="control">
            <div class="select">
              <select name="oil" id="create-select-oil" onchange="displayOil(this)">
                <option>Wähle eine Option</option>
                <option value="1 EL Kokosöl">Kokosöl</option>
                <option value="3 TL Hanföl">Hanföl</option>
                <option value="2 EL Olivenöl">Olivenöl</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <h2><label for="superfood" class="label title">Superfood</label></h2>
          <div class="control">
            <div class="select">
              <select name="superfood" id="create-select-superfood" onchange="displaySuperfood(this)">
                <option>Wähle eine Option</option>
                <option value="20 g getrocknete Kamillenblüten">getrocknete Kamillenblüten</option>
                <option value="10 g Mariendistel-Samen">Mariendistel-Samen</option>
                <option value="50 g Seealgenmehl">Seealgenmehl</option>
                <option value="1 TL Flohsamen">Flohsamen</option>
                <option value="1/4 TL Rosenblüten">Rosenblüten</option>
                <option value="1/4 TL Schafgarben">Schafgarben</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <h2><label class="label title">Form</label></h2>
        <div id="create-radio-container" class="control radio-container" onchange="displayForm(this)">
          <label class="radio">
            <input class="radio-btn" type="radio" name="answer" value="Knochen">
            Knochen
          </label>
          <label class="radio">
            <input class="radio-btn" type="radio" name="answer" value="Fisch">
            Fisch
          </label>
          <label class="radio">
            <input class="radio-btn" type="radio" name="answer" value="Stern">
            Stern
          </label>
          <label class="radio">
            <input class="radio-btn" type="radio" name="answer" value="Halbkugel">
            Halbkugel
          </label>
          <label class="radio">
            <input class="radio-btn" type="radio" name="answer" value="Herz">
            Herz
          </label>
          <label class="radio">
            <input class="radio-btn" type="radio" name="answer" value="Donut">
            Donut
          </label>
          <label class="radio">
            <input class="radio-btn" type="radio" name="answer" value="Pfoten">
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
                Bild
              </span>
            </span>
          </label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <label class="checkbox">
            <input type="checkbox">
            Ich bin damit einverstanden, dass mein Rezept gespeichert und veröffentlicht wird.
          </label>
        </div>
      </div>
      <div class="field is-grouped">
        <div class="control">
          <button class="button is-block is-primary" type="submit" name="createRecipe" id="createRecipe">Absenden</button>
        </div>
        <div class="control">
          <button class="button is-link is-light">Cancel</button>
        </div>
      </div>
    </form>




    <div id="recipe-result" class="contenteditable">
      <h2 id="recipe-result-title"></h2>
      <ul id="create-basic-ul"></ul>
      <ul id="create-add_on-ul"></ul>
      <ul id="create-oil-ul"></ul>
      <ul id="create-superfood-ul"></ul>
      <ul id="create-keksform-ul"></ul>
    </div>

  </div>

  <span class="close">&times;</span>
  <!-- Modal with Update Form -->
  <div id="myModal" class="modal">


  </div>


  <div class="show-recipe-container">
    <h2>Deine Rezepte</h2>
    <div class="recipe-container">
      <!-- Div for recipes -->
    </div>
  </div>
  <footer>
    <small>&copy; Monty's Tidbits 2022</small>
    <i class="fa-solid fa-sharpe fa-bone"></i>
  </footer>
  <script>
    window.addEventListener('load', function() {
    fetch('php/User.class.php?getSessionInfo')
        .then(res => res.json()) // .then means it waits until step before is completed.
        .then(function(data) {
      const sessionInfo = data
      if(data.hasOwnProperty('fk_user') && data['fk_user'] > 0){
        console.log(sessionInfo)
        document.querySelector('body').style.display = 'block'
      }
      else{
        window.location.href = "login.php";
      }
    })
  })
  </script>
</body>

</html>