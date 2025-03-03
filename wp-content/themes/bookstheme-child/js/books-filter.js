document.addEventListener('DOMContentLoaded', function () {
    const genreFilter = document.getElementById('genre-filter');
    const publisherFilter = document.getElementById('publisher-filter');

    function fetchBooks() {
        const genre = genreFilter.value;
        const publisher = publisherFilter.value;


        axios.get(booksFilter.rest_url, {
            params: {
                genre: genre,
                publisher: publisher
            }
        })
            .then(function (response) {
                const books = response.data;
                const booksList = document.getElementById('books-list');

                if (books.length === 0) {
                    booksList.innerHTML = '<p>No books found.</p>';
                    return;
                }

                let html = '';
                books.forEach(function (book) {
                    html += `
                        <div class="book-item">
                            <h2>${book.title}</h2>
                            <p>Author: ${book.author}</p>
                            <p>Price: $${book.price}</p>
                            <p>Release Date: ${book.release_date}</p>
                        </div>
                    `;
                });

                booksList.innerHTML = html;
            })
            .catch(function (error) {
                console.error('Error fetching books:', error);
            });
    }


    fetchBooks();


    genreFilter.addEventListener('change', fetchBooks);
    publisherFilter.addEventListener('change', fetchBooks);
});
