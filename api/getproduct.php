<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  require_once('../vendor/autoload.php');

  use Classes\Product;
try {
  $result = Product::fetchallproducts();
  echo $result;
} catch (\Throwable $e) {
  echo json_encode(array('status' => false, 'message' => $e->getMessage()));
}
 
?>
