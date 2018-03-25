Available methods: `fetchBooks()`, `fetchAuthors()`, `fetchBooksByAuthor()`.

Examples of usage:
```php
$api = new BooksApi\BooksApi;
$books = $api->fetchBooks(); // fetch all books
$books = $api->fetchBooks(new BooksApi\LimitScope(2)); // fetch first two books
$books = $api->fetchBooks(new BooksApi\LimitScope(null, 1)); // fetch all books, starting from second.
$books = $api->fetchBooks(new BooksApi\LimitScope(2, 1)); // fetch two books, starting from second.
$books = $api->fetchBooksByAuthor(2); // fetch books written by Author with ID = 2.
$books = $api->fetchBooksByAuthor(2, new BooksApi\LimitScope(3)); // fetch first three books written by Author with ID = 2.
$author = $api->fetchAuthors(); // fetch all authors
```