<?php 

class Pagination
{
   protected $dbConnection;
   protected $currentPage; // numer bieżącej strony
   protected $itemsOnPage; // ilość elementów na stronie
   protected $itemsCount;  // liczba elementów
   protected $pageCount;   // ilość stron

   function __construct($connection, $tableName, $itemsOnPage = 20)
   {
      $this->set_current_page(); // ustaw numer bieżącej strony
      $this->dbConnection = $connection;
      $this->itemsOnPage = $itemsOnPage;
      $this->itemsCount = $this->get_items_count($tableName);
      $this->pageCount = ceil($this->itemsCount / $this->itemsOnPage);
   }
   
   // pobierz numer bieżącej strony
   public function get_current_page()
   {
      return $this->currentPage;
   }
   
   // ustaw numer bieżącej strony
   protected function set_current_page()
   {
      if (isset($_GET['page'])) {
         $this->currentPage = intval($_GET['page']);
      } else {
         $this->currentPage = 1; // wartość domyślna
      }
   }

   // zwraca liczbę wierszy w tabeli
   protected function get_items_count($tableName)
   {
      $countQuery = "SELECT COUNT(*) AS items_count FROM $tableName";
      $result = $this->dbConnection->query($countQuery);

      if ($result) {
         $row = $result->fetch_assoc();
         return $row['items_count'];
      } else {
         return 0;
      }
   }

   // aktualizuje zapytanie
   public function update_query($query)
   {
      $start = ($this->currentPage * $this->itemsOnPage) - $this->itemsOnPage;
      $limitQuery = " LIMIT " . $start . "," . $this->itemsOnPage;
      
      return $query . $limitQuery;
   }

   public function add_widget()
   {
      echo "<ul class='pager'>";

      $url = basename($_SERVER['PHP_SELF']) . "?page=";

      for ($page=1; $page <= $this->pageCount; $page++) { 
         if ($page == $this->currentPage) {
            echo "<li><a class='page-active' href='" . $url . $page . "'>$page</a></li>";
         } else {
            echo "<li><a href='" . $url . $page . "'>$page</a></li>";
         }   
      }

      echo "</ul>";
   }
}

?>