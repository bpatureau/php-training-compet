

console.log("hello world")

let list_books = document.querySelector(".list-books")
axios.get(`http://localhost/prep-compet/api.php`)
.then(response => {
  console.log(response.data.records)
  response.data.records.forEach(e => {
    list_books.innerHTML += `<li data-id="${e.id}" class='list-book-item'> ${e.title} </li>`
  });
})
