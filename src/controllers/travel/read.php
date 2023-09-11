<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/travel.php';

$database = new Database();
$db = $database->getConnection();

$travel = new Travel($db);

$stmt = $travel->read();
$num = $stmt->rowCount();

if($num > 0) {
    $travel_arr = [];
    $travel_arr['records'] = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $travel_item = [
            'id' => $id,
            'name' => $name,
            'seats_available' => $seats_available
        ];
        array_push($travel_arr['records'], $travel_item);
    }
    echo json_encode($travel_arr);
} else {
    echo json_encode(
        ['message' => 'No travel found']
    );
}
