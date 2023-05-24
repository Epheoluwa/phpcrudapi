<?php
include_once '../classes/Product.php';
class Insertproduct extends Product{

     // Constructor with DB
     public function __construct($db) {
        $this->conn = $db;
      }
      
    public function createProduct($name, $sku, $price, $product_type, $size){

        return $this->createDVD($name, $sku, $price, $product_type, $size);
    }
    public function createBookProduct($name, $sku, $price, $product_type, $weight){

        return $this->createBook($name, $sku, $price, $product_type,$weight);
    }
    public function createFurnitureProduct($name, $sku, $price, $product_type, $height,$width,$length){

        return $this->createFurniture($name, $sku, $price,$product_type, $height,$width,$length);
    }
}