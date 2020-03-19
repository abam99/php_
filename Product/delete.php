<?php
//require header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Acess-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//include db & object file
include_once '../Config/database.php';
include_once '../Object/product.php';

//get db Connection 
$database = new Database();
$db = $database->getConnection();

//prepare product object 
$product = new Product($db);

//ambil id product
$data = json_encode(file_get_contents("php://input"));

//set product id to be deleted
$product->id = $data->id;
//delete product
if($product->delete()){
    //set response code - 200 OK
    http_response_code(200);
    //kasih tau user
    echo json_encode(array("message" => "Product was deleted."));
}else{ //kalo gabisa delete
    //set response code - 503 service unavailable
    http_response_code(503);
    //kasih tau user
    echo json_encode(array("message" => "Unable to delete product."));
}


