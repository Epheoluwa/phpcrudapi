<?php
include_once '../classes/Product.php';
class Insertproduct extends Product{

     // Constructor with DB
     public function __construct($db) {
        $this->conn = $db;
      }
      
    public function allProducts($name, $sku, $price, $product_type, $size){

        return $this->createdvd($name, $sku, $price, $product_type, $size);
    }
}