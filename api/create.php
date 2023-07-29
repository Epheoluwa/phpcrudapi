<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../vendor/autoload.php');

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

try {
    $productType = [
        "book" => 'Model\Book',
        "furniture" => 'Model\Furniture', 
        "dvd" => 'Model\Dvd'
    ];
    
    $product = new $productType[$data->productType]($data);
    $result = $product->create();
    if ($result) {
        echo json_encode(array('status' => true));
    } else {
        echo json_encode(array('status' => false));
    }
} catch (\Throwable $e) {
    echo json_encode(array('status' => false, 'message' => $e->getMessage()));
}
