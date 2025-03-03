
# WPBooks Readme
WP functions to create custom books with genre, publisher, author, price and release date, with advanced search to include acf+cpt datas and on page axios filter + REST API. Admin and editors can add books from landing page.

✅ Custom Post Type: books
✅ Custom Taxonomies: genre, publisher
✅ ACF Fields: author, price, release_date
✅ REST API Endpoint: /wp-json/books/v1/list
✅ Frontend Filter: Uses Axios for dynamic filtering
✅ Admin Panel: Books can be added via a landing page
❌ Absolutely NO styling applied

## Instalation
- git clone git@github.com:Alek-wdgt/WPBooks.git
- docker compose up -d
- http://localhost:8880/
- user: admin; pass: admin;
- REST API: http://localhost:8880/wp-json/books/v1/list
- filters available http://localhost:8880/wp-json/books/v1/list?page=1&per_page=10&&publisher=amazon

## Failback docker
- sql file => sql/codeflex.sql
- child theme => wp-content/themes/bookstheme-child
- Create page and use theme template to dispay all functions: SearchBooks
- Set permalinks to post name

