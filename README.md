## Pagination

Library that allows you to add pagination feature on your website

![alt text](https://github.com/dawidgorecki/pagination/blob/master/example.png)

### Usage
```php
// krok 1 - dołącz klasę
// step 1 - add class

require_once 'class-pagination.php';

// krok 2 - dołącz plik CSS
// step 2 - add CSS file

echo "<link rel='stylesheet' href='pagination.css'>";
   
// krok 3 - utwórz obiekt klasy Pagination, ostatni parametr jest opcjonalny
// step 3 - create object, last parameter is optional

$pagination = new Pagination($connection, 'table_name', 10);

// krok 4 - zaktualizuj zapytanie SQL
// step 4 - update query

$query = $pagination->update_query($query);

// krok 5 - dodaj widget
// step 5 - add widget

$pagination->add_widget();
```
