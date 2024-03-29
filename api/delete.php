<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json ');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../vendor/autoload.php');

use Classes\Product;

try {
    $value = json_decode(file_get_contents("php://input"));
    // print_r($value->id);
    $result = Product::delete($value->id);
    echo $result;
} catch (\Throwable $e) {
    echo json_encode(array('status' => false, 'message' => $e->getMessage()));
}

