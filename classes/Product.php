<?php

include_once '../config/Database.php';
abstract class Product extends Database
{
    private $table = 'product';

    public function read()
    {
        $query = "SELECT * FROM $this->table";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
       

        if($count > 0)
        {
          $products = array();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'sku' => $row['sku'],
                'price' => $row['price'],
                'product_type' => $row['product_type']
            );

            $product['size'] = ($row['product_type'] === 'dvd') ? $row['size'] : null;
            $product['weight'] = ($row['product_type'] === 'book') ? $row['weight'] : null;
            $product['height'] = ($row['product_type'] === 'furniture') ? $row['height'] : null;
            $product['width'] = ($row['product_type'] === 'furniture') ? $row['width'] : null;
            $product['length'] = ($row['product_type'] === 'furniture') ? $row['length'] : null;
            

            $products[] = $product;
        }

        return json_encode($products);
      }else{
         // Return this if not product
        $product = json_encode(
          ['message' => 'No Product Found']
        );
        return $product;
      }
    
    }

    public function createDVD($name, $sku, $price, $product_type, $size)
    {
        $query = "INSERT INTO $this->table (name, sku, price, product_type, size) 
                  VALUES (:name, :sku, :price, ':product_type', :size)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_type', $product_type);
        $stmt->bindParam(':size', $size);

        //Execute query
        try{
          $stmt->execute();
          return true;
        }
  
        catch(Exception $e){
              return false;
        }
    }

    public function createBook($name, $sku, $price, $product_type, $weight)
    {
        $query = "INSERT INTO $this->table (name, sku, price, product_type, weight) 
                  VALUES (:name, :sku, :price, ':product_type', :weight)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_type', $product_type);
        $stmt->bindParam(':weight', $weight);

           // Execute query
      try{
        $stmt->execute();
        return true;
      }

      catch(Exception $e){
            return false;
      }
    }

    public function createFurniture($name, $sku, $price,$product_type, $height, $width, $length)
    {
        $query = "INSERT INTO $this->table (name, sku, price, product_type, height, width, length) 
                  VALUES (:name, :sku, :price, ':product_type', :height, :width, :length)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_type', $product_type);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':length', $length);

          // Execute query
      try{
        $stmt->execute();
        return true;
      }

      catch(Exception $e){
            return false;
      }
    }

    public function delete($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>



