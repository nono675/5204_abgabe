<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration - Monty's Tidbits</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <!-- <link rel="stylesheet" type="text/css" href="../css/register.css"> -->

  <script defer src="js/register.js"></script>
</head>

<body>
  <section class="container login-container">
    <div class="columns is-multiline">
      <div class="column is-8 is-offset-2 register">
        <div class="columns">
          <div class="column left has-text-centered">
            <form id="registrationForm" method="post" action="registration.php">
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
              <!--  <div class="field">
                  <div class="control">
                    <input class="input is-medium" type="password" placeholder="Passwort bestätigen" id="PW_B" name="PW_B">
                  </div>
                </div> -->
              <button class="button is-block is-primary is-fullwidth is-medium" type="submit" name="go" id="go">Account erstellen</button>
              <br />
              <small><a href="login.php">Bereits registriert? Bitte hier entlang!</a></small>
            </form>
            <div class="success-container">

              <p>Dein Account wurde erfolgreich erstellt!</p>

              <a href="login.php">Hier geht's zum Login!</a>
            </div>
          </div>
          <div class="column right">
            <h1 class="title is-1">Registrierung</h1>
            <!-- Feedback -->
            <div id="feedback" class="feedback-container"></div>
            <p>Logge dich ein und kreiere und teile neue Leckerli-Rezepte für deinen Liebling!</p>
          </div>
        </div>
      </div>
      <div class="column is-8 is-offset-2">
        <br>
        <nav class="level">
          <div class="level-left">
            <div class="level-item">
              <span class="icon">
                <i class="fab fa-twitter"></i>
              </span> &emsp;
              <span class="icon">
                <i class="fab fa-facebook"></i>
              </span> &emsp;
              <span class="icon">
                <i class="fab fa-instagram"></i>
              </span> &emsp;
              <span class="icon">
                <i class="fab fa-github"></i>
              </span> &emsp;
              <span class="icon">
                <i class="fas fa-envelope"></i>
              </span>
            </div>
          </div>
          <div class="level-right">
            <small class="level-item" style="color: var(--textLight)">
              &copy; Super Cool Website. All Rights Reserved.
            </small>
          </div>
        </nav>
      </div>
    </div>
  </section>


</body>

</html>