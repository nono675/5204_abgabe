function getDataForSearch() {
    let searchBox = document.getElementById("search-input");

    console.log("dfsf"+searchBox)

    document.querySelector('.recipe-container').innerHTML = ""


	// fetch all recipes with joined zutaten and search applied..
	fetch(`php/Recipe.class.php?getalljoined&search=${searchBox.value}`)
		.then(res => res.json()) // .then means it waits until step before is completed.
		.then(function(data) {
			const all_recipes_joined = data
			console.log(all_recipes_joined)

			showRecipes(all_recipes_joined)
		})
}

function getOilFromZutatList(rezept_zutaten_list) {

    // Defines all possible Oil names
	const oils = ["1 EL Kokosöl", "3 TL Hanföl", "3 EL Olivenöl"];

    for(let i = 0; i < rezept_zutaten_list.length; i++) {
        if(oils.includes(rezept_zutaten_list[i])){
            return rezept_zutaten_list[i];
        }
    };
    return "";
}

function getSuperfoodFromZutatList(rezept_zutaten_list) {

    // Defines all possible Oil names
	const oils = ["getrocknete Kamillenblüten", "10 g Mariendistel-Samen", "50 g Seealgenmehl", "1 TL Flohsamen", "1/4 TL Rosenblüten", "1/4 TL Schafgarben"];

    for(let i = 0; i < rezept_zutaten_list.length; i++) {
        if(oils.includes(rezept_zutaten_list[i])){
            return rezept_zutaten_list[i];
        }
    };
    return "";
}