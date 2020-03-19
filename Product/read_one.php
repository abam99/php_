<?php
//require header
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

//include db & object files
include_once '../Config/database.php';
include_once '../Object/product.php';

//db connectionnya
$database = new Database();
$db = $database->getConnection();

//prepare product object
$product = new product($db);

//set ID buat di read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

//read details product yg udah di edit
$product->readOne();

if($product->name != null){
    //buat array
    $product_arr = array(
        "id" => $product->id,
        "name" => $product->name,
        "description" => $product->description,
        "price" => $product->price,
        "category_id" => $product->category_id,
        "category_name" => $product->category_name
    );

//set response code - 200 OK
http_response_code(200);

//json format
echo json_encode($product_arr);
    }else{
        //set response code - 404 Not Found
        http_response_code(404);

        //kasi tau user product not exist
        echo json_encode(array("message" => "Product does not exist."));
    }
?>
