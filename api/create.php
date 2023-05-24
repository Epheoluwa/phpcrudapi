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
if (
    isset($data->name) &&
    isset($data->sku) &&
    isset($data->price) &&
    isset($data->prod_type)
) {
    $name = $data->name;
    $sku = $data->sku;
    $price = $data->price;
    $product_type = $data->prod_type;

    // Create post ternary operator used to check product difference
    $result = (!empty($data->size)) ? $post->createProduct($name, $sku, $price, $product_type, $data->size) : 
              ((!empty($data->weight)) ? $post->createBookProduct($name, $sku, $price, $product_type, $data->weight) :
              $post->createFurnitureProduct($name, $sku, $price, $product_type, $data->height, $data->width, $data->length));

    if ($result) {
        echo json_encode(array('status' => true));
    } else {
        http_response_code(401);
        echo json_encode(array('status' => false));
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid input data'));
}
?>
