<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require_once __DIR__ . '/../../config/database.php'; 
require_once __DIR__ . '/../../models/country.php';

$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

$data = json_decode(file_get_contents('php://input'));

$country->name = $data->name;

if($country->delete()) {
    http_response_code(200);
    echo json_encode(['answer' => 'Country has been deleted']);
} else {
    http_response_code(503);
    echo json_encode(['answer' => "Can't delete the Country"]);
}
