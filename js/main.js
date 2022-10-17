
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

for (let i = 0; i < basicCheckboxes.length; i++) {
	basicCheckboxes[i].addEventListener("change", function(event) {
		console.log(basicCheckboxes[i])
		let selectetList = "";
		for (let j = 0; j < basicCheckboxes.length; j++) {
			if (basicCheckboxes[j].checked === true) {
				selectetList = `${selectetList} <li>${basicCheckboxes[j].value}</li>`
			}
		}
		basicUl.innerHTML += `<h2>Basis</h2><br>${selectetList}`
	});
}
for (let i = 0; i < meatCheckboxes.length; i++) {
	meatCheckboxes[i].addEventListener("change", function(event) {
		console.log(meatCheckboxes[i])
		let selectetList = "";
		for (let j = 0; j < meatCheckboxes.length; j++) {
			if (meatCheckboxes[j].checked === true) {
				selectetList = `${selectetList} <li>${meatCheckboxes[j].value}</li>`
			}
		}
		meatUl.innerHTML = `${selectetList}`
	});
}
for (let i = 0; i < cheeseCheckboxes.length; i++) {
	cheeseCheckboxes[i].addEventListener("change", function(event) {
		console.log(cheeseCheckboxes[i])
		let selectetList = "";
		for (let j = 0; j < cheeseCheckboxes.length; j++) {
			if (cheeseCheckboxes[j].checked === true) {
				selectetList = `${selectetList} <li>${cheeseCheckboxes[j].value}</li>`
			}
		}
		cheeseUl.innerHTML = `${selectetList}`
	});
}
for (let i = 0; i < fishCheckboxes.length; i++) {
	fishCheckboxes[i].addEventListener("change", function(event) {
		console.log(fishCheckboxes[i])
		let selectetList = "";
		for (let j = 0; j < fishCheckboxes.length; j++) {
			if (fishCheckboxes[j].checked === true) {
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





