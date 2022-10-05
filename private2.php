<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="css/private2.css">
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div >
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
            <strong>Home</strong>
          </a>
          <a href="login.php" class="button is-light">
            Log Out
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>

<div class="user"></div>



<div class="new-recipe">

<form class="recipe-form contenteditable" method="POST" action="private.php">
<div class="field">
  <label class="title label">Rezept-Name</label>
  <div class="control">
    <input id="recipe-title" class="input" type="text" name="title" placeholder="Text input">
  </div>
</div>
<div class="field">
<label class="checkbox label title">Basis</label>
<div class="checkbox-container">
<div class="ingredient">
  <input type="checkbox" name="checkbox[]" class="basic" id="Dinkelmehl" value="Dinkelmehl">
  Dinkelmehl
</div>
<div class="ingredient">
  <input type="checkbox" name="checkbox[]" class="basic" value="Kartoffelmehl" id="Kartoffelmehl">
  Kartoffelmehl
</div>
<div class="ingredient" >
  <input type="checkbox" name="checkbox[]" class="basic" value="Vollkornmehl">
  Vollkornmehl
</div>
<div class="ingredient">
  <input type="checkbox"  name="checkbox[]" class="basic"  value="Buchweizenmehl">
  Buchweizenmehl
</div>
<div class="ingredient">
  <input type="checkbox"  name="checkbox[]" class="basic" value="Weizenmehl">
  Weizenmehl
</div>
<div class="ingredient" >
  <input type="checkbox" name="checkbox[]" class="basic" value="Kichererbsenmehl">
  Kichererbsenmehl
</div>
  </div>
</div>
<div class="field">
<label class="checkbox label title">Geschmackszugabe</label>
<div class="ingredients field">
  <div class="ingredient-container">
    <h3>Fleisch</h3>
    <div class="ingredient" >
      <input type="checkbox" name="checkbox[]" class="meat" value="Leber">
      Leber
    </div>
    <div class="ingredient">
      <input type="checkbox" name="checkbox[]" class="meat" value="Hackfleisch">
      Hackfleisch
    </div>
    <div class="ingredient">
      <input type="checkbox" name="checkbox[]" class="meat" value="Schweineschmalz">
      Schweineschmalz
    </div>
    <div class="ingredient">
      <input type="checkbox" name="checkbox[]" class="meat" value="Gekochter Schinken">
      Gekochter Schinken
    </div>
  </div>
  <div class="ingredient-container">
    <h3>Käse</h3>
    <div class="ingredient" >
      <input type="checkbox" name="checkbox[]" class="cheese" value="Hüttenkäse">
      Hüttenkäse
    </div>
    <div class="ingredient">
      <input type="checkbox" name="checkbox[]" class="cheese" value="Parmesan">
      Parmesan
    </div>
    <div class="ingredient">
      <input type="checkbox"  name="checkbox[]" class="cheese" value="Cheedar">
      Cheddar
    </div>
  </div>
  <div class="ingredient-container">
    <h3>Fisch</h3>
    <div class="ingredient">
      <input type="checkbox" name="checkbox[]" class="fish" value="Sardinen">
      Sardinen
    </div>
    <div class="ingredient">
      <input type="checkbox" name="checkbox[]" class="fish" value="Thunfisch">
      Thunfisch
    </div>
    <div class="ingredient">
      <input type="checkbox" name="checkbox[]" class="fish" value="Lachsfilet">
      Lachsfilet
    </div>
  </div>
</div>
</div>
<div class="select-container">
  <div class="field">
    <label class="label title">Öl</label>
    <div class="control">
      <div class="select">
        <select id="select-oil" onchange="writeOil(this)">
          <option>Wähle eine Option</option>
          <option>Kokosöl</option>
          <option>Hanföl</option>
          <option>Olivenöl</option>
        </select>
      </div>
    </div>
  </div>
  <div class="field">
    <label class="label title">Superfood</label>
    <div class="control">
      <div class="select">
        <select id="select-superfood" onchange="writeSuperfood(this)">
          <option>Wähle eine Option</option>
          <option>getrocknete Kamillenblüten</option>
          <option>Mariendistel-Samen</option>
          <option>Seealgenmehl</option>
          <option>Flohsamen</option>
          <option>Rosenblüten</option>
          <option>Schafgarben</option>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="field">
  <label class="label title">Form</label>
<div class="control radio-container">
  <label class="radio">
    <input type="radio" name="answer">
    Knochen
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Fisch
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Stern
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Halbkugel
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Herz
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Donut
  </label>
  <label class="radio">
    <input type="radio" name="answer">
    Pfoten
  </label>
</div>
</div>
<div class="field">
<div class="file">
  <h3>Lade hier ein Foto deines Haustiers hoch!</h3>
  <label class="file-label">
    <input class="file-input" type="file" name="resume">
    <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Bild
      </span>
    </span>
  </label>
</div>
</div>
<div class="field">
  <div class="control">
    <label class="checkbox">
      <input type="checkbox">
      Ich bin damit einverstanden, dass mein Rezept gespeichert und veröffentlicht wird. 
    </label>
  </div>
</div>

<div class="field is-grouped">
  <div class="control">
    <button class="button is-block is-primary" type="submit" name="go" id="go">Absenden</button>
  </div>
  <div class="control">
    <button class="button is-link is-light">Cancel</button>
  </div>
</div>
</form>

<div id="recipe-result" class="contenteditable">
<h2 id="recipe-result-title"></h2>
  <ul id="basic-ul"></ul>
  <ul id="meat-ul"></ul>
  <ul id="cheese-ul"></ul>
  <ul id="fish-ul"></ul>
  <ul id="oil-ul"></ul>
  <ul id="superfood-ul"></ul>




</div>

</div>


<div class="recipe-container">


 


</div>

<script>

let basicCheckboxes = document.getElementsByClassName("basic");
let meatCheckboxes = document.getElementsByClassName("meat");
let cheeseCheckboxes = document.getElementsByClassName("cheese");
let fishCheckboxes = document.getElementsByClassName("fish");

let recipeSolutionTitle = document.getElementById("recipe-result-title");
let recipeResult = document.getElementById("recipe-result");
let basicUl = document.getElementById("basic-ul");
let meatUl = document.getElementById("meat-ul");
let cheeseUl = document.getElementById("cheese-ul");
let fishUl = document.getElementById("cheese-ul");
let oilUl = document.getElementById('oil-ul');
let superfoodUl = document.getElementById('superfood-ul');



let recipeTitle = document.getElementById("recipe-title");
recipeTitle.onkeyup = function() {
  recipeSolutionTitle.value = this.value;
  console.log(recipeSolutionTitle.value);

  recipeSolutionTitle.innerHTML =  recipeSolutionTitle.value 
}



// Checkbox-Ausgaben

	for (let i = 0; i < basicCheckboxes.length; i++) {
   		basicCheckboxes[i].addEventListener("change", function (event) {
        console.log(basicCheckboxes[i])
        let selectetList = "";
        for(let j = 0; j < basicCheckboxes.length; j++) {
          if(basicCheckboxes[j].checked === true) {
            selectetList = `${selectetList} <li>${basicCheckboxes[j].value}</li>` 
          }
        } 
        basicUl.innerHTML += `<h2>Basis</h2><br>${selectetList}`                         
      });
	}
  for (let i = 0; i < meatCheckboxes.length; i++) {
   		meatCheckboxes[i].addEventListener("change", function (event) {
        console.log(meatCheckboxes[i])
        let selectetList = "";
        for(let j = 0; j < meatCheckboxes.length; j++) {
          if(meatCheckboxes[j].checked === true) {
            selectetList = `${selectetList} <li>${meatCheckboxes[j].value}</li>` 
          }
        }                    
        meatUl.innerHTML = `${selectetList}`                         
      });
	}
  for (let i = 0; i < cheeseCheckboxes.length; i++) {
   		cheeseCheckboxes[i].addEventListener("change", function (event) {
        console.log(cheeseCheckboxes[i])
        let selectetList = "";
        for(let j = 0; j < cheeseCheckboxes.length; j++) {
          if(cheeseCheckboxes[j].checked === true) {
            selectetList = `${selectetList} <li>${cheeseCheckboxes[j].value}</li>` 
          }
        }                    
        cheeseUl.innerHTML = `${selectetList}`                         
      });
	}
  for (let i = 0; i < fishCheckboxes.length; i++) {
   		fishCheckboxes[i].addEventListener("change", function (event) {
        console.log(fishCheckboxes[i])
        let selectetList = "";
        for(let j = 0; j < fishCheckboxes.length; j++) {
          if(fishCheckboxes[j].checked === true) {
            selectetList = `${selectetList} <li>${fishCheckboxes[j].value}</li>` 
          }
        }                    
        fishUl.innerHTML = `${selectetList}`                         
      });
	}

// Select-Ausgaben
  function writeOil(trigger) {
		oilUl.innerHTML = `<li>Öl:  ${trigger.value}`;
	}
  function writeSuperfood(trigger) {
		superfoodUl.innerHTML = `<li>Superfood:  ${trigger.value}`;
	}

  

  // Edit



  getData ()

  function getData() {
  fetch('php/Recipe.class.php')
    .then(res => res.json())
    .then(function(data) {
      const new_data = data
      console.log(new_data)

      //showTitle(new_data)
      showRecipes(new_data)

    })
    //.catch(err => console.log(err))
  }

/*   function showTitle (new_data) {
      const titles = []
      new_data.forEach( recipe => {
        titles.push(recipe.title)
      })
      console.log(titles)

  } */

  function showRecipes(new_data) {

    console.log(new_data)
  
    new_data.forEach( recipes => {
      const div = document.createElement('div')
      div.className = 'contenteditable'
      const recipes_template = `
      <small>ID: ${recipes.id}</small>
      <h3>${recipes.title}</h3>
      <img>${recipes.image}</img}
      <p>${recipes.beschreib}</p>
      <small>Kreiert von: ${recipes.fk_user}</small>
      <div class="icon-container">
            <a id="edit" class="btn-custom" href="#" ><i class="fa-solid fa-pen-to-square"></i></a>
            <a class="btn-default" href="features/events/delete.php?task=delete&id=<?php  echo $datensatz['id'] ?>"><i class="fa-solid fa-trash"></i></a>
          </div>
      `
      div.innerHTML = recipes_template 
      document.querySelector('.recipe-container').appendChild(div)

      editRecipes(new_data)
    })
  }

  function editRecipes(new_data) {

    let edit = document.getElementById("edit")
    edit.addEventListener("click")
    "click" = false 
    new_data.forEach(editRecipes => {
      if ("click" === true) {
        console.log(`${editRecipes.id}`)
      }
    })
  
  
  
  }



		

</script>
</body>
</html>