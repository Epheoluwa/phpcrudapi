<?php
include_once '../config/Database.php';
abstract class Product extends Database {
    // DB stuff
    private $table = 'product';

     // Post Properties
     public $id;
     public $category_id;
     public $category_name;
     public $title;
     public $body;
     public $author;
     public $created_at;

    // // Get Products
    public function read($name) {
        // Create query
        $query = 'SELECT '.$name.' FROM '.$this->table.'';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Execute query
        $stmt->execute();
        $result = $stmt;

        // Get row count
        $num = $result->rowCount();
        // Check if any product
        if($num > 0){
          // Post array
          $prod_arr = array();
          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $prod_item = array(
              'id' => $id,
              'name' => $name,
              'sku' => $sku,
              'price' => $price,
              'product-type' => $product_type,
              'size' => $size,
              'weight' => $weight,
              'height' => $height,
              'width' => $width,
              'length' => $length
            );

            // Push to "data"
            array_push($prod_arr, $prod_item);
          }

          // Turn to JSON & output
          $product = json_encode($prod_arr);
        }else{
          // No Posts
          $product = json_encode(
            array('message' => 'No Posts Found')
          );
        }
  
        return $product;

      
    } 

    public function createdvd($name, $sku, $price, $product_type, $size) {
      // Create query
      $query = "INSERT INTO $this->table(name,sku,price,product_type,size) VALUE( '$name', '$sku','$price', '$product_type','$size')";

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      try{
        $stmt->execute();
        return true;
      }

      catch(Exception $e){
            return false;
      }
   
   
    }  
    public function createbook($name, $sku, $price, $product_type, $weight) {
      // Create query
      $query = "INSERT INTO $this->table(name,sku,price,product_type,weight) VALUE( '$name', '$sku','$price', '$product_type','$weight')";

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      try{
        $stmt->execute();
        return true;
      }

      catch(Exception $e){
            return false;
      }
       
    }  
    public function createfurniture($name, $sku, $price, $product_type, $height,$width,$length) {
      // Create query
      $query = "INSERT INTO $this->table(name,sku,price,product_type,height,width,length) VALUE( '$name', '$sku','$price', '$product_type','$height' ,'$width' ,'$length')";

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      try{
        $stmt->execute();
        return true;
      }

      catch(Exception $e){
            return false;
      }
   
    }  
    
    
    // Delete Product
    public function delete($id) {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = '.$id.'';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // abstract public function allProducts();

}
?>