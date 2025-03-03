document.addEventListener('DOMContentLoaded', function () {
    const genreFilter = document.getElementById('genre-filter');
    const publisherFilter = document.getElementById('publisher-filter');

    function fetchBooks() {
        const genre = genreFilter.value;
        const publisher = publisherFilter.value;

        // Fetch books with the selected filters
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
                    // Create links for title, author, publisher, and genre
                    html += `
                         <div class="book-item">
                        <h2><a href="${book.permalink}">${book.title}</a></h2>
                        <p>Author: ${book.author}</p>
                        <p>Price: $${book.price}</p>
                        <p>Release Date: ${book.release_date}</p>
                        <p>Genre: ${book.genres}</p>
                        <p>Publisher: ${book.publishers}</p>
                    </div>
                    </div>
                    `;
                });

                booksList.innerHTML = html;
            })
            .catch(function (error) {
                console.error('Error fetching books:', error);
            });
    }

    // Fetch books initially on page load
    fetchBooks();

    // Re-fetch books when filters change
    genreFilter.addEventListener('change', fetchBooks);
    publisherFilter.addEventListener('change', fetchBooks);
});
