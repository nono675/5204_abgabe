<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Monty's Tidbits</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">

  <!-- JS -->
  <script defer src="js/navbar.js"></script>
  <script defer src="js/login.js"></script>
</head>

<body>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span style="color: #555;" aria-hidden="true"></span>
        <span style="color: #555;" aria-hidden="true"></span>
        <span style="color: #555;" aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a href="index.php"><i class="fa-solid fa-sharpe fa-bone" style="color: #555;"></i></a>
        <h2>Monty's Tidbits</h2>
      </div>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a href="index.php" class="button is-primary sign_up">
              <strong>Home</strong>
            </a>
            <a href="login.php" class="button is-light">
              Login
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <section class="container login-container">
    <div class="columns is-multiline">
      <div class="column is-8 is-offset-2 register">
        <div class="columns">
          <div class="column left">
            <h1 class="title is-1">Willkommen zurück!</h1>
            <div id="feedback" class="feedback-container is-danger is-success">
            </div>
            <p>Logge dich ein und kreiere und teile neue Leckerli-Rezepte für deinen Liebling!</p>
          </div>
          <div class="column right has-text-centered">
            <form id="login_form" method="post" action="private.php">
              <div class="field">
                <div class="control">
                  <input class="input is-medium" type="text" placeholder="Username" id="username" name="username">
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <input class="input is-medium" type="password" placeholder="Passwort" id="PW" name="PW">
                </div>
              </div>
              <button class="button is-block is-primary is-fullwidth is-medium" type="submit" name="go" id="go">Anmelden</button>
              <br />
              <small><a href="registration.php">Noch kein Account? Hier kannst du dich registrieren!</a></small>
            </form>
          </div>
        </div>
      </div>
      <div class="column is-8 is-offset-2">
        <div class="level-right">
          <small class="level-item" style="color: var(--textLight)">
            &copy; Monty's Tidbits
          </small>
        </div>
      </div>
    </div>
  </section>
  <script>
    fetch('php/User.class.php?getSessionInfo')
      .then(res => res.json()) // .then means it waits until step before is completed.
      .then(function(data) {
        const sessionInfo = data
        if (data.hasOwnProperty('fk_user') && data['fk_user'] > 0) {
          console.log(sessionInfo)
          window.location.href = "private2.php";
        } else {
          //window.location.href = "login.php";
        }
      })
  </script>
</body>