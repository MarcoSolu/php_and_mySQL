<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require_once __DIR__ . '/../../config/database.php'; 
require_once __DIR__ . '/../../models/country.php';

$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

if (isset($_GET['travel_name'])) {
    $travelNAME = $_GET['travel_name'];

    $result = $country->filterByCountry($travelNAME);

    if ($result) {
        $countryArray = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $countryItem = [
                'id' => $id,
                'name' => $name,
                'travel_name' => $travel_name
            ];
            $countryArray[] = $countryItem;
        }

        http_response_code(200);

        echo json_encode($countryArray);
    } else {
        http_response_code(404);

        echo json_encode(['message' => "No travels found with travel_id = $travelID."]);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => "Invalid or missing 'travel_name' parameter in the GET request."]);
}
