
    // references from html elements
    let feedback = document.getElementById("feedback");
    let feedbackUsername = document.getElementById("feedback-username");
    let feedbackPassword = document.getElementsByClassName("feedback-password");
    let formular = document.getElementById("registrationForm");
    let username = document.getElementById("username");
    let password = document.getElementById("PW");
    let submitBtn = document.getElementById("go");

    //flags for the status of the user inputs
    let userNameValid = "no";
    let passwordValid = "no";

    //function check if both fields are valid
    function checkValid() {
      if (userNameValid == "yes" && passwordValid == "yes") {
        submitBtn.disabled = false;
      } else {
        submitBtn.disabled = true;
      }
    }
    //check if username exists
    username.addEventListener('keyup', (event) => {
      console.log('ich bin da!')
      console.log(username.value.length)
      if (username.value.length < 3) {
        submitBtn.disabled = true;
        feedbackUsername.innerHTML = "Dein Username muss mind. 3 Zeichen haben";
        return false;
      } else {
        feedbackUsername.innerHTML = "";
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
            username.style.borderColor = "red";
            userNameValid = "no";
            checkValid();
          } else {
            //user dont exist
            feedbackUsername.innerHTML = "Dieser Username ist noch frei!";
            username.style.borderColor = "green";
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
              password.style.borderBlockColor = "green";
              passwordValid = "yes";
              checkValid();
            } else {
              feedback.innerHTML = `<li>Das Passwort muss aus 8 bis 20 Zeichen bestehen.</li>
		                          <li>Es muss mindestens eine Zahl beinhalten.</li>
                              <li>Es darf nicht mit einer Zahl oder einem Sonderzeichen beginnen.</li>
                              <li>Es braucht ein Sonderzeichen: @, #, $ oder %.</li>
                              <li>Es darf keine deutschen Umlaute (äöü) enthalten.</li>`;
              password.style.boderColor = "red";
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
            formular.style.display = "none";

          } else {
            //account failed
            feedback.innerHTML = "account failed to create";
          }
        })
        .catch((error) => console.log(error))


    })
