let url = "http://localhost/prep-compet/api.php"
let list_books = document.querySelector(".list-books")
axios.get(url)
.then(response => {
  response.data.records.forEach(e => {
    list_books.innerHTML += `<li data-id="${e.id}"  class='list-book-item close'> <h2 data-id="${e.id}" class="titre">${e.title}</h2></li>`
  });
})
.catch(error => console.log(error))


list_books.addEventListener("click", e => {
  e.preventDefault() 
  if(e.target.parentNode.classList.contains("close")) {
  axios.get(url, {
    params: {
      id_books: e.target.dataset.id
    }
  })
  .then(response => {
    e.target.parentNode.innerHTML = `<li data-id="${response.data.records[0].id}"  class='list-book-item'> <h2 data-id="${response.data.records[0].id}" class="titre">${response.data.records[0].title}</h2> <div><p>author: ${response.data.records[0].authors}</p><p>publisher: ${response.data.records[0].publisher}</p> <p>how much pages: ${response.data.records[0].pageCount}</p><p>description: ${response.data.records[0].description} </p></div></li>`
  }) 
  .catch(error => console.log(error))
}

  else if(e.target.classList.contains("titre")){
    e.target.parentNode.innerHTML = `<li data-id="${e.target.dataset.id}"  class='list-book-item close'> <h2 data-id="${e.target.dataset.id}" class="titre">${e.target.innerHTML}</h2></li>`
  }
})


//__________

let input_isbn = document.querySelector(".input_isbn")
let form_main = document.querySelector(".form_main")

form_main.addEventListener("submit", e => {
  e.preventDefault()
  console.log(input_isbn.value)
  axios.get(`https://www.googleapis.com/books/v1/volumes?q=isbn:${input_isbn.value}`)

  .then(response => {
    input_isbn.value = ""
    list_books.innerHTML += `<li class='list-book-item close'> <h2 class="titre">${response.data.items[0].volumeInfo.title}</h2></li>`  
      axios.post(url, 
        response.data
      )
      .then(response => {
      }
      )
      .catch(error => console.log(error))
    
  })
  .catch(error => console.log(error))
})
