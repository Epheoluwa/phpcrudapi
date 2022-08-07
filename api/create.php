<?php
// Headers 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../model/Insertproduct.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate product  object
  $post = new Insertproduct($db);

    // var_dump($_POST);
    // exit;
    // $value =file_get_contents("php://input");
    // echo($value);
    // exit;
    $value =json_decode(file_get_contents("php://input"));
  
    // Get raw posted data
    $name = $value->name;
    $sku = $value->sku;
    $price = $value->price;
    $product_type = $value->prod_type;
    $size = $value->size;
    $weight = $value->weight;
    $height = $value->height;
    $length = $value->length;
    $width = $value->width;

    
    // isset($size) ? $result = $post->allProducts($name, $sku, $price, $product_type, $size): $result = "other" ;

    // Create post ternary operator used to check product difference
  $result =  (!empty($size)) ? $result = $post->allProducts($name, $sku, $price, $product_type, $size) : 
                ((!empty($weight)) ? $result = $post->allProductsbooks($name, $sku, $price, $product_type, $weight)  : 
                $result = $post->allProductsfurniture($name, $sku, $price, $product_type, $height,$width,$length));
  echo $result ;
    if($result) {
        echo json_encode(
        array('status' => true)
        );
    }else {
      header("X-PHP-Response-Code: 401", true, 401);
        echo json_encode(
        array('status' => false)
        );

        // http_response_code(401);
    }