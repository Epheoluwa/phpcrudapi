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

// Instantiate product object
$post = new Insertproduct($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if the required properties are present



    $name = $data->name;
    $sku = $data->sku;
    $price = $data->price;
    $product_type = $data->productType;



    // Create post ternary operator used to check product difference
    $result = (!empty($data->size)) ? $post->createProduct($name, $sku, $price, $product_type, $data->size) : 
              ((!empty($data->weight)) ? $post->createBookProduct($name, $sku, $price, $product_type, $data->weight) :
              $post->createFurnitureProduct($name, $sku, $price, $product_type, $data->height, $data->width, $data->length));


    if ($result) {
        echo json_encode(array('status' => true));

    } else {
        
        echo json_encode(array('status' => false));
        // http_response_code(401);
    }

?>
