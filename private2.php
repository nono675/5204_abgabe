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

<form id="recipe-form" class="recipe-form contenteditable" method="POST" action="">
<div class="field">
  <label class="title label">Rezept-Name</label>
  <div class="control">
    <input id="recipe-title" class="input" type="text" name="recipe-title" placeholder="Text input">
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
    <button class="button is-block is-primary" type="submit" name="createRecipe" id="createRecipe">Absenden</button>
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


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>


<div class="recipe-container">


 


</div>

<script>

  
let recipeForm = document.getElementById("recipe-form")
let recipeFormTitle = document.getElementById("recipe-title")

let formTemplate = document.getElementsByClassName("recipe-form contenteditable")
let modal = document.getElementById("myModal")
// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];


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


// insert data in db
recipeForm.addEventListener ("submit", function (event) {
	event.preventDefault();
	let formData = new FormData();
	formData.append('recipe-title', recipeFormTitle.value);
  let checkBoxes = recipeForm.querySelectorAll('.basic, .meat, .fish, .cheese')
  for (let i = 0; i < checkBoxes.length; i++) {
         formData.append(checkBoxes[i].value, checkBoxes[i].checked)
      }
      console.log(formData)


	fetch('php/Recipe.class.php?createRecipe', {
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
			formular.style.display="none";

		}
		else {
			//account failed
			feedback.innerHTML = "account failed to create";
		}
	}
	)
	.catch((error) => console.log(error))

			
	})

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
    // fetch all recipes (for user) with joined zutaten.
    fetch('php/Recipe.class.php?getalljoined')
    .then(res => res.json()) // .then means it waits until step before is completed.
    .then(function(data) {
      const all_recipes_joined = data
      console.log(all_recipes_joined)

      showRecipes(all_recipes_joined)
    })

  }

  function showRecipes(all_recipes_joined) {

    // all_recipes_joined has structure
    // id(recipe.id) | title | beschreib ....... | zutaten_name | fk_rezepte
    // 1             | T5000 | abc               | Leber        | 1
    // 1             | T5000 | abc               | Cheese       | 1
    // 2             | T2222 | xyz               | Leber        | 2

    // but we want only 1 post it per recipe id.. That's why we group it.
    console.log(all_recipes_joined)

    const rezepte_grupiert = all_recipes_joined.reduce((groups, item) => {
        const group = (groups[item.rezept_id] || []);
        group.push(item);
        groups[item.rezept_id] = group;
        return groups;
      }, {});

    // rezepte_grupiert has structure
    // key     id(recipe.id) | title | beschreib ....... | zutaten_name | fk_rezepte
    // [0]
    //         1             | T5000 | abc               | Leber        | 1             [0] ArrayIndex
    //         1             | T5000 | abc               | Leber        | 1             [1] ArrayIndex
    // [1]
    //         2             | T2222 | xyz               | Leber        | 2             [0] ArrayIndex

    // Now we can loop throu each key to ensure we will have only one posy it per recipe.
    console.log(rezepte_grupiert);
    Object.keys(rezepte_grupiert).forEach( key => {

      rezept_gruppe = rezepte_grupiert[key];      

      // Creates a new html div (not know by the html file so far)
      const div = document.createElement('div')
      div.className = 'contenteditable'
      div.id = `rezept_nr${rezept_gruppe[0].rezept_id}` // we can always use 0 as index if we want to knoe a vaue from recipe tabel. Since all values of recipe table are the same within rezept_gruppe.

      // ASsign template with attach edit and delete buttons.
      const recipes_template = `
      <small>ID: ${rezept_gruppe[0].rezept_id}</small>
      <h3>${rezept_gruppe[0].title}</h3>
      <img>${rezept_gruppe[0].image}</img}
      <p>${rezept_gruppe[0].beschreib}</p>
      <small>Kreiert von: ${rezept_gruppe[0].fk_user}</small>
      <div class="icon-container">
            <a id="edit_nr${rezept_gruppe[0].rezept_id}" class="btn-custom edit" href="#" ><i class="fa-solid fa-pen-to-square"></i></a>
            <a class="btn-default" href="features/events/delete.php?task=delete&id=${rezept_gruppe[0].rezept_id}"><i class="fa-solid fa-trash"></i></a>
          </div>
      `
      div.innerHTML = recipes_template 
      // Add the new html div to the exitsing html file
      document.querySelector('.recipe-container').appendChild(div)

      // Subscribe onClick methods for edit button
      editRecipes(rezept_gruppe)
    })
    
  }

  function editRecipes(rezept_gruppe) {

    let rezeptId = rezept_gruppe[0].rezept_id; // we can always use 0 as index if we want to knoe a vaue from recipe tabel. Since all values of recipe table are the same within rezept_gruppe.

    // Get edit button
    let edit = document.getElementById(`edit_nr${rezeptId}`)

    // Subscripe click event
    edit.addEventListener("click", function (event) {
        console.log(edit)

      modal.style.display = "block";

      // Get recipe edit form (partially prefilled)
      modal.innerHTML = returnFilledForm(rezept_gruppe)
    
      // Select all zutaten_name of rezept_gruppe
      let rezept_zutaten = rezept_gruppe.map(a => a.zutaten_name);
      // Select all check boxes which exist in modal and have one of these classes
      var checkBoxes = modal.querySelectorAll('.basic, .meat, .fish, .cheese')
      console.log(rezept_zutaten)

      // Loop through all check boxes fro modal
      // If rezept_zutaten contains the value of the check box, it means the zutat exists for this recipe in the db. Thus we set the check box to checked.
      for (let i = 0; i < checkBoxes.length; i++) {
          if(rezept_zutaten.includes(checkBoxes[i].value)){
            console.log(checkBoxes[i].value)
            checkBoxes[i].checked = true;
          }
      }
    })

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
  }

  function returnFilledForm (rezept_gruppe) {  
    return `
    <form class="recipe-form contenteditable" method="POST" action="private.php">
<div class="field">
  <label class="title label">Rezept-Name</label>
  <div class="control">
    <input id="recipe-title" class="input" type="text" name="title" placeholder="Text input" value="${rezept_gruppe[0].title}">
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

    
    `


    
    
  }



		

</script>
</body>
</html>