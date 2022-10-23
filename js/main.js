
let recipeForm = document.getElementById("create-recipe-form");
let recipeFormTitle = document.getElementById("recipe-title");
let titleFeedback = document.getElementById("title-feedback");

let formTemplate = document.getElementsByClassName("recipe-form contenteditable");
let modal = document.getElementById("myModal");
// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];


let basicCheckboxes = document.getElementsByClassName("basic");
let meatCheckboxes = document.getElementsByClassName("meat");
let cheeseCheckboxes = document.getElementsByClassName("cheese");
let fishCheckboxes = document.getElementsByClassName("fish");

let recipeSolutionTitle = document.getElementById("recipe-result-title");
let recipeResult = document.getElementById("recipe-result");
let oilUl = document.getElementById('oil-ul');
let superfoodUl = document.getElementById('superfood-ul');

recipeFormTitle.addEventListener('keyup', (event) => {
	console.log('hallo titel');
	if(recipeFormTitle.value.length == 0 || recipeFormTitle.value.length < 3 || recipeFormTitle.value.length == "") {
		console.log('der titel ist zu kurz')
		titleFeedback.innerHTML = "Bitte gib einen Titel ein!"
		recipeFormTitle.style.backgroundColor = "#feecf0";
		recipeFormTitle.style.border = "";
	}
	else {
		titleFeedback.innerHTML = "";
		recipeFormTitle.style.border = "3px solid #00d1b2";
		recipeFormTitle.style.backgroundColor = "";
	}
})
// insert new recipe in db
recipeForm.addEventListener("submit", function(event) {

	let formData = new FormData(recipeForm);

	fetch('php/Recipe.class.php', {
			method: "post",
			body: formData,
		})
		.then((res) => res.json())
		.then(function(data) {
		})
		.catch((error) => console.log(error))
})

let recipeTitle = document.getElementById("recipe-title");
recipeTitle.onkeyup = function() {
	recipeSolutionTitle.value = this.value;
	console.log(recipeSolutionTitle.value);

	recipeSolutionTitle.innerHTML = recipeSolutionTitle.value
}

// Checkbox-Ausgaben
addChangeEventToBasicCheckBoxes('create')
addChangeEventToAddOnCheckBoxes('create')

// Select-Ausgaben
function displayOil(dropDownElement) {

	// Select the according UL of depending onn dropDown id (create or update)
	let currentUl = null
	if(dropDownElement.id.includes("create")){
		currentUl = document.getElementById('create-oil-ul')
	}
	else if(dropDownElement.id.includes("update")){
		currentUl = document.getElementById('update-oil-ul')
	}

	// If selected value of drop contains 'Wähle' Oil should not be displayed
	if(dropDownElement.value.includes("Wähle")){
		currentUl.innerHTML = ``;
	}
	else{
		currentUl.innerHTML = `<h3>Öl</h3><br>${dropDownElement.value}`;
	}
}

function displaySuperfood(dropDownElement) {
	// Select the according UL of depending onn dropDown id (create or update)
	let currentUl = null
	if(dropDownElement.id.includes("create")){
		currentUl = document.getElementById('create-superfood-ul')
	}
	else if(dropDownElement.id.includes("update")){
		currentUl = document.getElementById('update-superfood-ul')
	}

	// If selected value of drop contains 'Wähle' Superfood should not be displayed
	if(dropDownElement.value.includes("Wähle")){
		currentUl.innerHTML = ``;
	}
	else{
		currentUl.innerHTML = `<h3>Superfood</h3><br>${dropDownElement.value}`;
	}
}

function displayForm(radioButtonContainer) {

	// Select all radio buttons of radioButtonContainer
	let radioButtons = radioButtonContainer.querySelectorAll('.radio-btn')

	// Select the according UL depending radioButtonContainer id (create or update)
	let currentUl = null
	if(radioButtonContainer.id.includes("create")){
		currentUl = document.getElementById('create-keksform-ul')
	}
	else if(radioButtonContainer.id.includes("update")){
		currentUl = document.getElementById('update-keksform-ul')
	}
	currentUl.innerHTML = ``;

	// Go through all radio buttons of radioButtonContainer and check if selected (checked)
	for (let i = 0; i < radioButtons.length; i++) {
		if (radioButtons[i].checked == true) {
			currentUl.innerHTML = `<h3>Form</h3><br>${radioButtons[i].value}`;
		}
	}
}

function logoutUserWithButton() {

	fetch('php/User.class.php?logout')
	.then((res) => res.json())
	.then(function(data) {
		console.log(data)
		window.location.href = "login.php";
		// hier könnte man dann dem user anzeigen, dass das neue rezept erstellt worden ist.
	})
	.catch((error) => console.log(error))

	fetch('php/User.class.php?getSessionInfo')
		.then(res => res.json()) // .then means it waits until step before is completed.
		.then(function(data) {
			const sessionInfo = data
			console.log(data)
		})
}

