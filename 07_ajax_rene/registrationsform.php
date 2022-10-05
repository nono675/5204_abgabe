<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Registrations Formular</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="container">
	<h2>Registrations Formular</h2>
	<div id="feedback"></div>
	<form method="post" action="registrationsform.php" id="myForm">
		<div class=formcontrol>
			<label for="userName">Username:</label>
			<input type="text" id="userName" name="userName" value="">
		</div>
		<div class=formcontrol>
			<label for="Passwort">Passwort:</label>
			<input type="text" id="PW" name="PW">
      </div>
		<p>Ihr Passwort muss eine Länge von 8 bis 20 Zeichen haben und mind. eine Zahl aufweisen.<br>
		Ausserdem muss es ein Sonderzeichen enthalten (! @ # %).<br>
		Das Passwort muss mit einem Buchstaben beginnen.</p>
		<br>
      <div class=formcontrol>        
      <button type="submit" name="go" id="go" disabled>Account erstellen</button>
      </div>
   </form>
	<script>
// references from html elements
let feedback = document.getElementById("feedback"); 
let formular = document.getElementById("myForm"); 
let username = document.getElementById("userName"); 
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
				feedback.innerHTML = "fail";
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
</div>
</body>
</html>
