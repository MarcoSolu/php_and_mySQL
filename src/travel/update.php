<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/travel.php';

$database = new Database();
$db = $database->getConnection();

$travel = new Travel($db);

$data = json_decode(file_get_contents('php://input'));

$travel->id = $data->id;
$travel->name = $data->name;
$travel->seats_available = $data->seats_available;

if($travel->update()) {
    http_response_code(200);
    echo json_encode(['answer' => 'Travel updated']);
} else {
    http_response_code(503);
    echo json_encode(['answer' => "Can't update the travel"]);
}
