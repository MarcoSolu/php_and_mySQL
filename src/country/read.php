<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . '/../config/database.php'; 
require_once __DIR__ . '/../models/country.php';

$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

$stmt = $country->read();
$num = $stmt->rowCount();

if($num > 0) {
    $country_arr = [];
    $country_arr['records'] = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $country_item = [
            'id' => $id,
            'name' => $name,
            'travel_name' => $travel_name
        ];
        array_push($country_arr['records'], $country_item);
    }
    echo json_encode($country_arr);
} else {
    echo json_encode(
        ['message' => 'No country found']
    );
}
