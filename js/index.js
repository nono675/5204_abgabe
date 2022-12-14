



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
	Object.keys(rezepte_grupiert).forEach(key => {

		rezept_gruppe = rezepte_grupiert[key];
    let rezeptTitle = rezept_gruppe[0].title
    let rezeptForm = rezept_gruppe[0].form
    let rezeptUser = rezept_gruppe[0].fk_user


    // Select all zutaten_name of rezept_gruppe
    let rezept_zutaten = rezept_gruppe.map(a => a.zutaten_name);
    let selectetList = "";

    let formData = new FormData();
    rezept_zutaten.forEach(zutat => {
      formData.append('checkbox[]', zutat)
    })
    fetch("php/Recipe.class.php?calculateBasicAmounts", {
    method: "post",
    body: formData,
    })
    .then((res) => res.json())
    .then(function(data) {
        console.log(data)
        if(data != null){

            for(var gewichtPerZutat in data){
                selectetList = `${selectetList} <li>${gewichtPerZutat+' : '+ data[gewichtPerZutat] + ' g'}</li>`
                //console.log(selectetList)
            }
        }
        // Creates a new html div (not know by the html file so far)
        const div = document.createElement('div')
        div.className = 'contenteditable'
        div.id = `rezept_nr${rezept_gruppe[0].rezept_id}` // we can always use 0 as index if we want to knoe a vaue from recipe tabel. Since all values of recipe table are the same within rezept_gruppe.
    
    
        const recipes_template = `
          <h3>${rezeptTitle}</h3>
          <div>${selectetList}</div>
          <button id="accordion${key}" class="accordion">Beschreib</button>
          <div class="panel">
            <p>Heize den Backofen auf 150??C Umluft vor.</p>
            <p>Falls n??tig, sch??le und/oder zerkleinere die gew??hlte Geschmackszutat.</p>
            <p>Gib alle Zutaten in den Mixer und f??ge 3 Eier hinzu. Dann so viel Wasser dazugeben, bis ein z??hfl??ssiger Teig entsteht.</p>
            <p>Streiche den Teig auf die <span>${rezeptForm}</span>-Silikonbackmatte und im Ofen 35-60 min (je nach Feuchtigkeitsgrad der verwendeten Zutaten) backen.</p>
            <p>Backofen ausschalten und die Kekse ca. 2 Studen bei leicht ge??ffneter Backofent??r trocknen lassen.
          </div>
          <small>Kreiert von: ${rezeptUser}</small>
      `
        div.innerHTML = recipes_template
        // Add the new html div to the exitsing html file
        document.querySelector('.recipe-container').appendChild(div)
    
          // accordion
      
      let acc = document.getElementById("accordion"+key);
    
    
        acc.addEventListener("click", function() {
          this.classList.toggle("active");
          console.log(div.innerHTML)
          let panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          } 
        });
    }
    )
    .catch((error) => console.log(error))

	})
}


