function addChangeEventToBasicCheckBoxes(rezept_form_prefix){ // create / update / read
    // Select the form where the checkboxes belong to (can be create form or update form (recipe-form / update-recipe-form))
    let formOfEvent = document.getElementById(rezept_form_prefix + '-recipe-form')
    let basicCheckboxes = formOfEvent.getElementsByClassName("basic");
    let basicUl = document.getElementById(rezept_form_prefix + "-basic-ul");
    for (let i = 0; i < basicCheckboxes.length; i++) {
        basicCheckboxes[i].addEventListener("change", function (event) {
            // Create new formData and add the form (only selected checkBoxes are in the form)
            let formData = new FormData(formOfEvent);
            fetch("php/Recipe.class.php?calculateBasicAmounts", {
            method: "post",
            body: formData,
            })
            .then((res) => res.json())
            .then(function(data) {
                console.log(data)
                basicUl.innerHTML = `` // reset Basic list (delete Basic section if no Basic checkbox is checked)
                if(data != null){
                    let selectetList = "";
                    for(var gewichtPerZutat in data){
                        console.log(gewichtPerZutat)
                        console.log(data[gewichtPerZutat])
                        selectetList = `${selectetList} <li>${gewichtPerZutat+' : '+ data[gewichtPerZutat] + ' g'}</li>`
                    }
                    basicUl.innerHTML = `<h2>Basis</h2><br>${selectetList}`
                }
            }
            )
            .catch((error) => console.log(error))
        });
    }
}

function addChangeEventToMeatCheckBoxes(rezept_form_prefix){ // create / update / read
    // Select the form where the checkboxes belong to (can be create form or update form (recipe-form / update-recipe-form))
    let formOfEvent = document.getElementById(rezept_form_prefix + '-recipe-form')
    let checkboxes = formOfEvent.getElementsByClassName("meat");
    let ul = document.getElementById(rezept_form_prefix + "-meat-ul");
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener("change", function (event) {
            // Create new formData and add the form (only selected checkBoxes are in the form)
            let formData = new FormData(formOfEvent);
            fetch("php/Recipe.class.php?calculateMeatAmounts", {
            method: "post",
            body: formData,
            })
            .then((res) => res.json())
            .then(function(data) {
                console.log(data)
                ul.innerHTML = `` // reset Meat list (delete Meat section if no Meat checkbox is checked)
                if(data != null){
                    let selectetList = "";
                    for(var gewichtPerZutat in data){
                        console.log(gewichtPerZutat)
                        console.log(data[gewichtPerZutat])
                        selectetList = `${selectetList} <li>${gewichtPerZutat+' : '+ data[gewichtPerZutat] + ' g'}</li>`
                    }
                    ul.innerHTML = `<h2>Fleisch</h2><br>${selectetList}`
                }
            }
            )
            .catch((error) => console.log(error))
        });
    }
}

function addChangeEventToCheeseCheckBoxes(rezept_form_prefix){ // create / update / read
    // Select the form where the checkboxes belong to (can be create form or update form (recipe-form / update-recipe-form))
    let formOfEvent = document.getElementById(rezept_form_prefix + '-recipe-form')
    let checkboxes = formOfEvent.getElementsByClassName("cheese");
    let ul = document.getElementById(rezept_form_prefix + "-cheese-ul");
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener("change", function (event) {
            // Create new formData and add the form (only selected checkBoxes are in the form)
            let formData = new FormData(formOfEvent);
            fetch("php/Recipe.class.php?calculateCheeseAmounts", {
            method: "post",
            body: formData,
            })
            .then((res) => res.json())
            .then(function(data) {
                console.log(data)
                ul.innerHTML = `` // reset Cheese list (delete Cheese section if no Cheese checkbox is checked)
                if(data != null){
                    let selectetList = "";
                    for(var gewichtPerZutat in data){
                        console.log(gewichtPerZutat)
                        console.log(data[gewichtPerZutat])
                        selectetList = `${selectetList} <li>${gewichtPerZutat+' : '+ data[gewichtPerZutat] + ' g'}</li>`
                    }
                    ul.innerHTML = `<h2>Käse</h2><br>${selectetList}`
                }
            }
            )
            .catch((error) => console.log(error))
        });
    }
}

function addChangeEventToFishCheckBoxes(rezept_form_prefix){ // create / update / read
    // Select the form where the checkboxes belong to (can be create form or update form (recipe-form / update-recipe-form))
    let formOfEvent = document.getElementById(rezept_form_prefix + '-recipe-form')
    let checkboxes = formOfEvent.getElementsByClassName("fish");
    let ul = document.getElementById(rezept_form_prefix + "-fish-ul");
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener("change", function (event) {
            // Create new formData and add the form (only selected checkBoxes are in the form)
            let formData = new FormData(formOfEvent);
            fetch("php/Recipe.class.php?calculateFishAmounts", {
            method: "post",
            body: formData,
            })
            .then((res) => res.json())
            .then(function(data) {
                console.log(data)
                ul.innerHTML = `` // reset Fish list (delete Fish section if no Fish checkbox is checked)
                if(data != null){
                    let selectetList = "";
                    for(var gewichtPerZutat in data){
                        console.log(gewichtPerZutat)
                        console.log(data[gewichtPerZutat])
                        selectetList = `${selectetList} <li>${gewichtPerZutat+' : '+ data[gewichtPerZutat] + ' g'}</li>`
                    }
                    ul.innerHTML = `<h2>Fisch</h2><br>${selectetList}`
                }
            }
            )
            .catch((error) => console.log(error))
        });
    }
}