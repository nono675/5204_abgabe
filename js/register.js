
    // references from html elements
    let feedback = document.getElementById("feedback");
    let feedbackVorname = document.getElementById("feedback-vorname");
    let feedbackNachname = document.getElementById("feedback-nachname");
    let feedbackUsername = document.getElementById("feedback-username");
    let feedbackPassword = document.getElementsByClassName("feedback-password");
    let successContainer = document.getElementById("success-container")
    let formular = document.getElementById("registrationForm");
    let vorname = document.getElementById("vorname");
    let nachname = document.getElementById("nachname");
    let username = document.getElementById("username");
    let password = document.getElementById("PW");
    let submitBtn = document.getElementById("go");

    //flags for the status of the user inputs
    let vornameValid = "no";
    let nachnameValid = "no";
    let userNameValid = "no";
    let passwordValid = "no";
    

    //function check if both fields are valid
    function checkValid() {
      if (vornameValid == "yes" && nachnameValid == "yes" && userNameValid == "yes" && passwordValid == "yes") {
        submitBtn.disabled = false;
      } else {
        submitBtn.disabled = true;
      }
    }

    vorname.addEventListener('keyup', (event) => {
      console.log('vorname: ich bin da!')
      if(vorname.value.length < 2) {
        feedbackVorname.innerHTML = "Dein Vorname muss mind. 1 Buchstaben haben!";
        vorname.style.backgroundColor = "#feecf0";
        vorname.style.border = "";
        vornameValid = "no";
        checkValid();
      } else {
        feedbackVorname.innerHTML = "";
        vorname.style.border = "3px solid #00d1b2";
        vorname.style.backgroundColor = "";
        vornameValid = "yes";
        checkValid();
      }
    })
    nachname.addEventListener('keyup', (event) => {
      console.log('nachname: ich bin da!')
      if(nachname.value.length < 2) {
        feedbackNachname.innerHTML = "Dein Vorname muss mind. 1 Buchstaben haben!";
        nachname.style.backgroundColor = "#feecf0";
        nachname.style.border = "";
        nachnameValid = "no";
        checkValid();
      } else {
        feedbackNachname.innerHTML = "";
        nachname.style.border = "3px solid #00d1b2";
        nachname.style.backgroundColor = "";
        nachnameValid = "yes";
        checkValid();
      }
    })
    //check if username exists
    username.addEventListener('keyup', (event) => {
      console.log('username: ich bin da!')
      //console.log(username.value.length)
      if (username.value.length < 3) {
        feedbackUsername.innerHTML = "Dein Username muss mind. 3 Zeichen haben";
        username.style.backgroundColor = "#feecf0";
        
      } else {
        feedbackUsername.innerHTML = "";
        username.style.border = "3px solid #00d1b2";
  
      }
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
            feedbackUsername.innerHTML = "Dieser Username existiert bereits!";
            username.style.backgroundColor = "#feecf0";
            username.style.border = "";
            userNameValid = "no";
            checkValid();
          } else {
            //user dont exist
            feedbackUsername.innerHTML = "Dieser Username ist noch frei!";
            username.style.border = "3px solid #00d1b2";
            username.style.backgroundColor = "";
            userNameValid = "yes";
            checkValid();
          }
        })
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
              feedbackPassword.innerHTML = "Das Passwort entspricht den Vorgaben!";
              password.style.border = "3px solid #00d1b2";
              password.style.backgroundColor = "";
              passwordValid = "yes";
              checkValid();
            } else {
              feedback.innerHTML = `
                              <li>Das Passwort muss aus 8 bis 20 Zeichen bestehen.</li>
		                          <li>Es muss mindestens eine Zahl beinhalten.</li>
                              <li>Es darf nicht mit einer Zahl oder einem Sonderzeichen beginnen.</li>
                              <li>Es braucht ein Sonderzeichen: @, #, $ oder %.</li>
                              <li>Es darf keine deutschen Umlaute (äöü) enthalten.</li>`;
              password.style.backgroundColor = "#feecf0";
              password.style.border = "";
              passwordValid = "no";
              checkValid();
            }
          })
          .catch((error) => console.log(error))
      }
    })

    // insert data in db
    formular.addEventListener("submit", function(event) {
      event.preventDefault();
      let formData = new FormData();
      formData.append('vorname', vorname.value);
      formData.append('nachname', nachname.value);
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
            feedback.style.display = "none";
            formular.style.display = "none";
            successContainer.innerHTML = `<h2>Hurra <span>${username.value}</span>!!</h2>
            <i class="fa-solid fa-check"></i>
            <p>Dein Account wurde erfolgreich erstellt!</p>
            <a href="login.php">Hier geht's zum Login!</a>
            `



          } else {
            //account failed
            feedback.innerHTML = "account failed to create";
          }
        })
        .catch((error) => console.log(error))


    })
