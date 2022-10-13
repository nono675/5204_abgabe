<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Monty's Tidbits</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <!-- <link rel="stylesheet" type="text/css" href="../css/register.css"> -->
</head>

<body>
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
  <script>
    let feedback = document.getElementById("feedback");
    let formular = document.getElementById("login_form");
    let username = document.getElementById("username");
    let password = document.getElementById("PW");
    let submitBtn = document.getElementById("go");

    formular.addEventListener("submit", function(event) {
      event.preventDefault();
      let formData = new FormData();
      formData.append('username', username.value);
      formData.append('password', password.value);
      formData.append('login', "test3");
      fetch('php/User.class.php', {
          method: "post",
          body: formData,
        })
        .then((res) => res.json())
        .then(function(data) {
          console.log(data);
          // Von PHP wird true oder false gesendet
          if (data) {
            //account created
            window.location.href = "private2.php";


          } else {
            //account failed
            feedback.innerHTML = "Username oder Passwort falsch! Bitte überprüfe deine Eingaben!";
          }
        })
        .catch((error) => console.log(error))


    })
  </script>
</body>