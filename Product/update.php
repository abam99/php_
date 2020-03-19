<?php
//require header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Heades, Authorization, X-Requested-With");

//Include db & object file
include_once '../Config/database.php';
include_once '../Object/product.php';

//get db connection
$database = new Database();
$db = $database->getConnection();

//prepare product object
$product = new Product($db);

//ambil id product utk edit
$data = json_encode(file_get_contents("php://input"));

//set id property utk edit
$product->id = $data->id;

//set property values si product
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

//update product
if($product->update()){
    //set response code - 200 OK
    http_response_code(200);

    //kasih tau user
    echo json_encode(array("message" => "Product was update."));
}else{ //kalo gabisa update, kasih tau user
    //set response code - 503 service unavailable
    http_response_code(503);
    //kasih tau user
    echo json_encode(array("message" => "Unable to update product."));
}