<?php

namespace Classes;

use Config\Database;

abstract class Product
{

    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $conn;

    public function __construct($inputs)
    {
        $this->sku = $inputs->sku;
        $this->name = $inputs->name;
        $this->price = $inputs->price;
        $this->type = $inputs->productType;
        $this->conn = new Database();
    }

    public static function fetchallproducts()
    {

        $dbConn = new Database();
        $result = $dbConn->queryproduct("SELECT * FROM product");
        return $result;
    }

    public function create()
    {
        $query = "INSERT INTO product (name, sku, price, product_type, attribute) 
                  VALUES (:name, :sku, :price, :product_type, :attribute)";

        $this->conn->query($query);
        $this->conn->bind(':name', $this->name);
        $this->conn->bind(':sku', $this->sku);
        $this->conn->bind(':price', $this->price);
        $this->conn->bind(':product_type', $this->type);
        $this->conn->bind(':attribute', $this->attribute);
        $this->conn->execute();
        return 'saved';
    }

    public  static function delete($id)
    {
        $dbConn = new Database();
        for ($i = 0; $i < count($id); $i++) {
            $prodID = $id[$i];
            $dbConn->query("DELETE FROM product where id = :id");
            $dbConn->bind(':id',  $prodID);
            $dbConn->execute();
        }

        return json_encode(array('status' => true));

    }
}
