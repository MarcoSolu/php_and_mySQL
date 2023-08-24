<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/travel.php';

$database = new Database();
$db = $database->getConnection();
$travel = new Travel($db);
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->name) &&
    !empty($data->seats_available)
){
    $travel->name = $data->name;
    $travel->seats_available = $data->seats_available;
 
    if($travel->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Travel has been created."));
    }
    else{
        //503 servizio non disponibile
        http_response_code(503);
        echo json_encode(array("message" => "Can't create the travel"));
    }
}
else{
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Can't create the travel. Bad Response"));
}
?>