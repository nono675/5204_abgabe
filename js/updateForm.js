function editRecipes(rezept_gruppe) {

	let rezeptId = rezept_gruppe[0].rezept_id; // we can always use 0 as index if we want to knoe a vaue from recipe tabel. Since all values of recipe table are the same within rezept_gruppe.
	// Edit Button erstellen
	let editButton = document.getElementById(`edit_nr${rezeptId}`)
	let deleteButton = document.getElementById(`delete_nr${rezeptId}`)

	// Click Event für Delete Button
	deleteButton.addEventListener("click", function(event) {
		fetch(`php/Recipe.class.php?id=${rezeptId}`, {
			method: "delete"
		})
		.then((res) => res.json())
		.then(function(data) {
			console.log(data)
			window.location.href = "private2.php";
			// hier könnte man dann dem user anzeigen, dass das neue rezept erstellt worden ist.
		})
		.catch((error) => console.log(error))
	})

	// Click Event für Edit Button
	editButton.addEventListener("click", function(event) {
		console.log(editButton)
		// Modal mit Update Form wird angezeigt
		modal.style.display = "block";
		span.style.display = "block";

		// Rezept wird mit DB-Daten gefüllt
		modal.innerHTML = returnFilledForm(rezept_gruppe)

		// Select all zutaten_name of rezept_gruppe
		let rezept_zutaten = rezept_gruppe.map(a => a.zutaten_name);
		// Select all check boxes which exist in modal and have one of these classes
		let checkBoxes = modal.querySelectorAll('.basic, .meat, .fish, .cheese')
		let selectBoxOil = modal.querySelector('#update-select-oil')
		let oilOptions = selectBoxOil.querySelectorAll('option')
		let selectBoxSuperfood = modal.querySelector('#update-select-superfood')
		let superfoodOptions = selectBoxSuperfood.querySelectorAll('option')
		let radioShape = modal.querySelectorAll('.radio-btn')
		let radioButtonContainer = modal.querySelector('#update-radio-container')
		
		console.log('blabla')
		console.log(oilOptions)

		// Loop through all check boxes fro modal
		// If rezept_zutaten contains the value of the check box, it means the zutat exists for this recipe in the db. Thus we set the check box to checked.
		for (let i = 0; i < checkBoxes.length; i++) {
			if (rezept_zutaten.includes(checkBoxes[i].value)) {
				console.log(checkBoxes[i].value)
				checkBoxes[i].checked = true;
			}
		}
		for (let i = 0; i < oilOptions.length; i++) {
			if (rezept_zutaten.includes(oilOptions[i].value)) {
				console.log(oilOptions[i].value)
				selectBoxOil.value = oilOptions[i].value
			}
		}
		for (let i = 0; i < superfoodOptions.length; i++) {
			if (rezept_zutaten.includes(superfoodOptions[i].value)) {
				console.log(superfoodOptions[i].value)
				selectBoxSuperfood.value = superfoodOptions[i].value
			}
		}
		console.log('blablabla')
		console.log(rezept_gruppe[0].form)
		console.log(radioShape)
		for (let i = 0; i < radioShape.length; i++) {
			if (rezept_gruppe[0].form === radioShape[i].value) {
				console.log(radioShape[i].value)
				radioShape[i].checked = true
			}
		}


		// add event listener to basic check boxes of update form
		addChangeEventToBasicCheckBoxes('update')
		// simulate "change" event to fill out List with Zutaten
		modal.querySelector('.basic').dispatchEvent(new Event('change')); // first select ONE basic checkBox and create a new event for this check box

		// add event listener to Add-On check boxes of update form
		addChangeEventToAddOnCheckBoxes('update')
		// simulate "change" event to fill out List with Zutaten
		modal.querySelector('.meat').dispatchEvent(new Event('change')); // first select ONE meat checkBox and create a new event for this check box

		// call "onchange" method for Oil Drop Dwon to display Oil if stored
		selectBoxOil.onchange(selectBoxOil);

		// call "onchange" method for Superfood Drop Dwon to display Superfood if stored
		selectBoxSuperfood.onchange(selectBoxSuperfood);

		// call "onchange" method for RadioButtonContainer to display KeksForm
		radioButtonContainer.onchange(radioButtonContainer);

		// Select Rezept Title Input element
		let recipeSolutionTitle = modal.querySelector("#recipe-result-title");
		let recipeTitle = modal.querySelector("#recipe-title");

		// Set Stored Recipe Title in Box ()
		recipeSolutionTitle.innerHTML = recipeTitle.value;
		
		// Define onKeyUp function to display title when changed
		recipeTitle.onkeyup = function() {
			recipeSolutionTitle.value = this.value;
			console.log(recipeSolutionTitle.value);

			recipeSolutionTitle.innerHTML = recipeSolutionTitle.value
		}

		// When all existing (title, checkboxes etc.) are loaded to the edit form, 
		// we can subscribe the submit event for the updateRecipeForm. (very similar to create new recipe)
		let updateRecipeForm = document.getElementById('update-recipe-form')
		updateRecipeForm.addEventListener("submit", function(event) {
			let formData = new FormData(updateRecipeForm);
			formData.append('id', rezept_gruppe[0].rezept_id) // Necessary for SQL queries and to filter $_POST['id']

			fetch("php/Recipe.class.php", {
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
		span.style.display = "none";
	}
}

function returnFilledForm(rezept_gruppe) {
	return `
	<div class="header-updateform">
		<h2>Update hier dein Rezept!</h2>
		<i class="fa-solid fa-sharpe fa-bone"></i>
	</div>
	<div class="flex-container">
		<form id='update-recipe-form'class="recipe-form" method="POST">
			<div class="field">
				<h2>Rezeptname</h2>
				<div class="control">
					<input id="recipe-title" class="input" type="text" name="recipe-title" placeholder="Dein Rezeptname" value="${rezept_gruppe[0].title}">
				</div>
			</div>
			<div class="field">
				<h2>Basis</h2>
				<div class="checkbox-container">
					<div class="ingredient">
						<input type="checkbox" name="checkbox[]" class="basic" id="Dinkelmehl" value="Dinkelmehl">
						Dinkelmehl
					</div>
					<div class="ingredient">
						<input type="checkbox" name="checkbox[]" class="basic" value="Kartoffelmehl" id="Kartoffelmehl">
						Kartoffelmehl
					</div>
					<div class="ingredient">
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
				<h2>Geschmackszugabe</h2>
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
							<input type="checkbox"  name="checkbox[]" class="cheese" value="Cheddar">
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
					<h2><label for="oil" class="label title">Öl</label></h2>
					<div class="control">
						<div class="select">
							<select name="oil" id="update-select-oil" onchange="displayOil(this)">
								<option>Wähle eine Option</option>
								<option value="1 EL Kokosöl">Kokosöl</option>
								<option value="3 TL Hanföl">Hanföl</option>
								<option value="2 EL Olivenöl">Olivenöl</option>
							</select>
						</div>
					</div>
				</div>
				<div class="field">
					<h2><label for="superfood" class="label title">Superfood</label></h2>
					<div class="control">
						<div class="select">
							<select name="superfood" id="update-select-superfood" onchange="displaySuperfood(this)">
								<option>Wähle eine Option</option>
								<option value="20 g getrocknete Kamillenblüten">getrocknete Kamillenblüten</option>
								<option value="10 g Mariendistel-Samen">Mariendistel-Samen</option>
								<option value="50 g Seealgenmehl">Seealgenmehl</option>
								<option value="1 TL Flohsamen">Flohsamen</option>
								<option value="1/4 TL Rosenblüten">Rosenblüten</option>
								<option value="1/4 TL Schafgarben">Schafgarben</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="field">
				<h2><label class="label title">Form</label></h2>
				<div id="update-radio-container" class="control radio-container" onchange="displayForm(this)">
					<label class="radio">
						<input type="radio" class="radio-btn" name="answer" value="Knochen">
						Knochen
					</label>
					<label class="radio">
						<input type="radio" class="radio-btn" name="answer" value="Fisch">
						Fisch
					</label>
					<label class="radio">
						<input type="radio" class="radio-btn" name="answer" value="Stern">
						Stern
					</label>
					<label class="radio">
						<input type="radio" class="radio-btn" name="answer" value="Halbkugel">
						Halbkugel
					</label>
					<label class="radio">
						<input type="radio" class="radio-btn" name="answer" value="Herz">
						Herz
					</label>
					<label class="radio">
						<input type="radio" class="radio-btn" name="answer" value="Donut">
						Donut
					</label>
					<label class="radio">
						<input type="radio" class="radio-btn" name="answer" value="Pfoten">
						Pfoten
					</label>
				</div>
			</div>
			<div class="field is-grouped">
				<div class="control">
					<button class="button is-block is-primary" type="submit" name="go" id="go">Updaten</button>
				</div>
			</div>
		</form>

		<div id="recipe-result" class="contenteditable">
			<h2 id="recipe-result-title"></h2>
			<ul id="update-basic-ul"></ul>
			<ul id="update-add_on-ul"></ul>
			<ul id="update-oil-ul"></ul>
			<ul id="update-superfood-ul"></ul>
			<ul id="update-keksform-ul"></ul>
		</div>
	</div>
`




}

