<?php
//require header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include db&object
include_once '../Config/core.php';
include_once '../Config/database.php';
include_once '../Object/product.php';

//inisiasi db & product object
$database = new Database();
$db = $database->getConnection();

//Inisiasi object
$product = new Product($db);

//get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

//query products
$stmt = $product->search($keywords);
$num = $stmt->rowCount();

//check if > 0 record found
if($num>0){
    //products array
    $products_arr=array();
    $products_arr["records"]=array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //extract row
        //this will make $row['name'] to
        //just $name only
        extract($row);

        $product_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );
        array_push($products_arr["records"], $product_item);
    }

    //set response code - 200 OK
    http_response_code(200);
    //kasih tau user no product found
    echo json_encode(array("message" => "No products found."));
}
?>