<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monty's Tidbits</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Handlee&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <!-- <link rel="stylesheet" type="text/css" href="../css/register.css"> -->


  <!-- JS -->
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
        <!-- <div class="navbar-start">
      <a class="navbar-item">
        Home
      </a>
    </div> -->
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
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique obcaecati culpa aut modi a temporibus suscipit, dolor itaque aliquam iure!</p>
      <div class="search_field">
        <input class="input is-primary" type="text" list="games" name="search" id="search">
        <datalist id="games">
        </datalist>
        <input class="button is-light" type="submit" value="Suchen" class="search-button">
      </div>
    </form>
  </header>
  <div class="container">
    <ul class="gameseries">
    </ul>
  </div>
  <section class="recipe-container">

  </section>







  <footer>
    <small>&copy; Monty's Tidbits 2022</small>
    <i class="fa-solid fa-sharpe fa-bone"></i>
  </footer>


</body>



</html>