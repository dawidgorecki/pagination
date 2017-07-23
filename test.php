<?php

// krok 1 - dołącz klasę
require_once 'class-pagination.php';

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_USER_PASSWORD', '');
define('DB_NAME', 'example');

// połącz z bazą danych
$connection = new mysqli(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);

// sprawdź połączenie
if ($connection->connect_errno) {
   // błąd połączenia
   die("Connect error: " . $connection->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Pagination</title>

   <!-- krok 2 - dołącz plik CSS -->
   <link rel="stylesheet" href="pagination.css">
</head>
<body>

<?php 
   $query = "SELECT * FROM table_name";

   // krok 3 - utwórz obiekt klasy Pagination
   // ostatni parametr jest opcjonalny - określa liczbę elementów na stronie
   $pagination = new Pagination($connection, 'table_name', 10);

   // krok 4 - zaktualizuj zapytanie SQL korzystając z metody update_query()
   $query = $pagination->update_query($query);

   $result = $connection->query($query);

   // krok 5 - dodaj widget
   $pagination->add_widget();
?>
   <!-- wyświetl dane -->
   <table>
      <thead>
         <tr>
            <th>Kolumna 1</th>
            <th>Kolumna 2</th>
            <th>Kolumna 3</th>
         </tr>
      </thead>
      <tbody>

<?php
         while ($row = $result->fetch_assoc()) {
            $columnA = $row['col1'];
            $columnB = $row['col2'];
            $columnC = $row['col3'];

            echo "<tr>";
               echo "<td>$columnA</td>";
               echo "<td>$columnB</td>";
               echo "<td>$columnC</td>";
            echo "</tr>";
         }
?>

      </tbody>
   </table>
</body>
</html>