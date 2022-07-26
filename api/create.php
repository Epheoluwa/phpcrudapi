<?php
// Headers 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
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
    $value =json_decode(file_get_contents("php://input"));
    // Get raw posted data
    $name = $value->name;
    $sku = $value->sku;
    $price = $value->price;
    $product_type = $value->product_type;
    $size = $value->size;
    // Create post
    $result = $post->allProducts($name, $sku, $price, $product_type, $size);
    if($result) {
        echo json_encode(
        array('message' => 'Product Created')
        );
    } else {
        echo json_encode(
        array('message' => 'Product Not Created')
        );
    }