
getData()

function getData() {
  fetch('php/Recipe.class.php?getalljoined')
    .then(res => res.json())
    .then(function(data) {
      const new_data = data
      console.log(new_data)

      //showTitle(new_data)
      showRecipes(new_data)

    })
  //.catch(err => console.log(err))
}



function showRecipes(new_data) {

  console.log(new_data)

  new_data.forEach(recipes => {
    const div = document.createElement('div')
    div.className = 'contenteditable'
    const recipes_template = `
<small>ID: ${recipes.id}</small>
<h3>${recipes.title}</h3>
<img>${recipes.image}</img}
<p>${recipes.beschreib}</p>
<small>Kreiert von: ${recipes.fk_user}</small>
`
    div.innerHTML = recipes_template
    document.querySelector('.recipe-container').appendChild(div)

  })
}
