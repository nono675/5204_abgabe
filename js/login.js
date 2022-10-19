
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
