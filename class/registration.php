<?php
require("prefs/credentials.php");
require("class/User.class.php");
$dbInst = new User($host,$dbname,$user,$passwd);

if(isset($_POST['go'])) {
	$username = $_POST['username'];
	$pwKlartext = $_POST['PW'];
  $pwB = $_POST['PW_B'];

	// Checkt ob es den Username bereits gibt
	$usercheck = $dbInst->checkUserExist($username);
	if ($usercheck) {
		$feedback = "Dieser Username existiert schon";
	}
	else {
		// Erstellt einen neuen User, falls der noch nicht vorhanden ist
    if($pwKlartext === $pwB) {

      $suchmuster = '$S*(?=S{8,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$';
      if (preg_match($suchmuster, $pwKlartext)) {
        
        $dbInst->createMethod($username, $pwKlartext);
		    $feedback = "Der Account wurde erstellt!";
      }
      else {
        // nein
        $feedback = "Ihr Passwort entspricht nicht den Vorgaben!";
      }
      } else {
        $feedback = "Passwörter stimmen nicht überein!";
      }
    } 
	} 

else {
	$username = "";
	$feedback = "";
}

?>

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

    <script defer src="code.js"></script>
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
                    <input class="input is-medium" type="text" placeholder="Username" id="username" name="username" value="<?=$username?>">
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <input class="input is-medium" type="password" placeholder="Passwort" id="PW" name="PW">
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <input class="input is-medium" type="password" placeholder="Passwort bestätigen" id="PW_B" name="PW_B">
                  </div>
                </div>
                <button class="button is-block is-primary is-fullwidth is-medium" type="submit" name="go" id="go">Account erstellen</button>
                <br />
                <small><a href="#">Bereits registriert? Bitte hier entlang!</a></small>
              </form>
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

    <script>
      // references from html elements
      let feedback = document.getElementById("feedback"); 
      let formular = document.getElementById("registrationForm"); 
      let username = document.getElementById("username"); 
      let password = document.getElementById("PW"); 
      let submitBtn = document.getElementById("go"); 

      //flags for the status of the user inputs
      let userNameValid ="no";
      let passwordValid ="no";

      //function check if both fields are valid
      function checkValid(){
        if (userNameValid =="yes" && passwordValid=="yes"){
          submitBtn.disabled = false;
        }else{
          submitBtn.disabled = true;
        }
      }
      //check if username exists
      username.addEventListener('keyup', (event) => {
        let formData = new FormData();
        formData.append('username', username.value);
        formData.append('userCheck', "test");
        fetch('php/User.class.php', {
          method: "post",
          body: formData,
        })
        .then((res) => res.json())
        .then(function(data) {
          console.log(data);
          // Von PHP wird true oder false gesendet
          if (data) {
            //user exist
            feedback.innerHTML = "user exists already";
            username.style.background = "red";
            userNameValid = "no";
            checkValid();
          }
          else {
            //user dont exist
            feedback.innerHTML = "user available";
            username.style.background = "green";
            userNameValid = "yes";
            checkValid();
          }
        }
        )
        .catch((error) => console.log(error))
      })

      //check is password is in regex form
password.addEventListener('keyup', (event) => {
	let formData = new FormData();
	formData.append('password', password.value);
	// Erst ab 3 eingegebenen Zeichen soll die Maschinerie in Gang gesetzt werden
	// Dies schont die Ressourcen
	if (password.value.length >= 1) {
		fetch('php//regex_validation.php', {
			method: "post",
			body: formData,
		})
		.then((res) => res.json())
		.then(function(data) {
			console.log(data);
			if (data) {
				feedback.innerHTML = "works";
				password.style.backgroundColor = "green";
				passwordValid ="yes";
				checkValid();
			}
			else {
				feedback.innerHTML = `<li>Das Passwort muss aus 8 bis 20 Zeichen bestehen.</li>
		                          <li>Es muss mindestens eine Zahl beinhalten.</li>
                              <li>Es darf nicht mit einer Zahl oder einem Sonderzeichen beginnen.</li>
                              <li>Es braucht ein Sonderzeichen: @, #, $ oder %.</li>
                              <li>Es darf keine deutschen Umlaute (äöü) enthalten.</li>`;
				password.style.backgroundColor = "lightsalmon";
				passwordValid ="no";
				checkValid();
			}
		}
		)
		.catch((error) => console.log(error))
	}
})

// insert data in db
formular.addEventListener ("submit", function (event) {
	event.preventDefault();
	let formData = new FormData();
	formData.append('username', username.value);
	formData.append('password', password.value);
	formData.append('create', "test2");
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
			feedback.innerHTML = "account created";
			formular.style.display="none"
		}
		else {
			//account failed
			feedback.innerHTML = "account failed to create";
		}
	}
	)
	.catch((error) => console.log(error))

			
	})



    </script>
</body>
</html>
