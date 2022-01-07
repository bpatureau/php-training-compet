

console.log("hello world")

let list_books = document.querySelector(".list-books")
axios.get(`http://localhost/prep-compet/api.php`)
.then(response => {
  console.log(response.data.records)
  response.data.records.forEach(e => {
    list_books.innerHTML += `<li data-id="${e.id}" class='list-book-item hide-bot'> <h2 class="titre">${e.title}</h2> <div><p>author: ${e.authors}</p><p>publisher: ${e.publisher}</p> <p>how much pages: ${e.pageCount}</p><p>description: ${e.description} </p></div></li>`
  });
})


list_books.addEventListener("click", e => {
  e.preventDefault() 
  e.target.parentNode.classList.toggle("hide-bot")
})