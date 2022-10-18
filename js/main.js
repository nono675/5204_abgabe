
let recipeForm = document.getElementById("create-recipe-form")
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
let oilUl = document.getElementById('oil-ul');
let superfoodUl = document.getElementById('superfood-ul');


// insert new recipe in db
recipeForm.addEventListener("submit", function(event) {
	event.preventDefault();
	let formData = new FormData(recipeForm);
	console.log(formData['recipe-title'])

	fetch('php/Recipe.class.php', {
			method: "post",
			body: formData,
		})
		.then((res) => res.json())
		.then(function(data) {
			console.log(data)
			// hier könnte man dann dem user anzeigen, dass das neue rezept erstellt worden ist.
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
function writeOil(trigger) {
	oilUl.innerHTML = `<li>Öl:  ${trigger.value}`;
}

function writeSuperfood(trigger) {
	superfoodUl.innerHTML = `<li>Superfood:  ${trigger.value}`;
}
