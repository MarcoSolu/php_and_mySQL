<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/country.php';
 
$database = new Database();
$db = $database->getConnection();
 
$country = new Country($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$country->name = $data->name;
$country->travel_name = $data->travel_name;
 
if($country->update()){
    http_response_code(200);
    echo json_encode(array("answer" => "Country updated"));
}else{
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("answer" => "Can't update the country"));
}
?>