<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/travel.php';

$database = new Database();
$db = $database->getConnection();

$travel = new Travel($db);

if (isset($_GET['seats_available'])) {
    $seatsAvailable = $_GET['seats_available'];

    $result = $travel->filterBySeats($seatsAvailable);

    if ($result) {
        $travelsArray = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $travelItem = [
                'id' => $id,
                'name' => $name,
                'seats_available' => $seats_available
            ];
            $travelsArray[] = $travelItem;
        }

        http_response_code(200);

        echo json_encode($travelsArray);
    } else {
        http_response_code(404);

        echo json_encode(['message' => "No travels found with seats_available = $seatsAvailable."]);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => "Invalid or missing 'seats_available' parameter in the GET request."]);
}
