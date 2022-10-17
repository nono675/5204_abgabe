getData()

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
	Object.keys(rezepte_grupiert).forEach(key => {

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
				<a class="btn-default" id="delete_nr${rezept_gruppe[0].rezept_id}" href="#"><i class="fa-solid fa-trash"></i></a>
			</div>
	`
		div.innerHTML = recipes_template
		// Add the new html div to the exitsing html file
		document.querySelector('.recipe-container').appendChild(div)

		// Subscribe onClick methods for edit button
		editRecipes(rezept_gruppe)
	})
}