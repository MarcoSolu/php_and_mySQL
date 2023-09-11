<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/travel.php';

$database = new Database();
$db = $database->getConnection();
$travel = new Travel($db);
$data = json_decode(file_get_contents('php://input'));

if (
    empty($data->name) &&
    empty($data->seats_available) 
) {
    http_response_code(400);
    echo json_encode(array("message" => "Can't create the travel. Bad  Response"));
    return;  
}  
$travel->name = $data->name;
$travel->seats_available = $data->seats_available;  
if (!$travel->create()) {
    http_response_code(503);
    echo json_encode(array("message" => "Can't create the travel"));  
    return;
}
http_response_code(201);
echo json_encode(array("message" => "Travel has been created."));