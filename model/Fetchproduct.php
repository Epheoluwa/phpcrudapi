<?php

include_once '../classes/Product.php';

class Fetchproduct extends Product{
  
      // Constructor with DB
      public function __construct($db) {
        $this->conn = $db;
        
      }

      public function allProducts()
      {
        return $this->read();
      }
}