<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monty's Tidbits</title>
  <meta name="description" content="Kreiere Leckerli-Rezepte für deinen Hund und teile sie mit anderen Hundebesitzern!">
  <meta name="copyright" content="Monty's Tidbits">

  <!-- Favicon -->
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Handlee&display=swap" rel="stylesheet">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bulma -->
  <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/recipe-postits.css">
  <link rel="stylesheet" href="css/accordion.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- JS -->
  <script defer src="js/functions.js"></script>
  <script defer src="js/navbar.js"></script>
  <script defer src="js/index.js"></script>
</head>

<body>
  <header>
    <div class="logo-container">
      <h1>Monty's Tidbits</h1>
      <i class="fa-solid fa-sharpe fa-bone"></i>
    </div>
    <nav class="navbar" role="navigation" aria-label="main navigation">
      <div>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <a href="registration.php" class="button is-primary sign_up">
                <strong>Registrieren</strong>
              </a>
              <a href="login.php" class="button is-light">
                Login
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <form class="search">
      <p>Egal ob als Snack für zwischendurch oder als Belohnung für ein erflogreiches Training - jeder Hund liebt leckere Hundekekse. Umso wichtiger ist es, dass du weisst, was in den Leckereien steckt, die dein geliebter Vierbeiner täglich bekommt. Hier kannst du deine eigenen, gesunden Leckerlis ganz ohne künstliche Farbstoffe, Aromen und Konservierungsstoffen, kreieren und mit anderen teilen . Mit Hilfe einer Backmatte gelingt die Herstellung einfach und schnell.</p>
      <div class="search_field">
        <input id="search-input" class="input is-primary" type="text" name="search" id="search">
        <input id="search-button" class="button is-primary" value="Suchen" class="search-button" onclick="getDataForSearch()">
      </div>
    </form>
  </header>
  <section class="recipe-container">
    <!-- Section for Recipes -->
  </section>
  <!-- Footer -->
  <footer>
    <small>&copy; Monty's Tidbits 2022</small>
    <i class="fa-solid fa-sharpe fa-bone"></i>
  </footer>
</body>

</html>