<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../model/Deleteproduct.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate product object
$post = new Deleteproduct($db);

$value =json_decode(file_get_contents("php://input"));
$id = $value->id;

$result = $post->delete($id);
if ($result) {
    echo json_encode(
        array('message' => 'Product Deleted')
        );
}else {
    echo json_encode(
    array('message' => 'Product Not Deleted')
    );
}