<?php
include_once '../classes/Product.php';
class Deleteproduct extends Product{
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteproduct($id){
        return $this->delete($id);
    }

}