Available methods: `fetchBooks()`, `fetchAuthors()`, `fetchBooksByAuthor()`.

Examples of usage:
```php

use BooksApi\BooksApi;
use BooksApi\LimitScope\LimitScope;

$api = new BooksApi;
$books = $api->fetchBooks(); // fetch all books.
$books = $api->fetchBooks(new LimitScope(2)); // fetch first two books.
$books = $api->fetchBooks(new LimitScope(null, 1)); // fetch all books, starting from second.
$books = $api->fetchBooks(new LimitScope(2, 1)); // fetch two books, starting from second.
$books = $api->fetchBooksByAuthor(2); // fetch all books written by Author with ID = 2.
$books = $api->fetchBooksByAuthor(2, new LimitScope(3)); // fetch first three books written by Author with ID = 2.
$authors = $api->fetchAuthors(); // fetch all authors.
```