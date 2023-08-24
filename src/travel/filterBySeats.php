<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/travel.php';

$database = new Database();
$db = $database->getConnection();

$travel = new Travel($db);

// Check if the 'seats_available' parameter exists in the GET request
if (isset($_GET['seats_available'])) {
    // Get the seats_available value from the GET parameters
    $seatsAvailable = $_GET['seats_available'];

    // Call the filterBySeats function with the provided value
    $result = $travel->filterBySeats($seatsAvailable);

    if ($result) {
        // Initialize an array to store the rows
        $travelsArray = array();

        // Fetch the rows one by one and add them to the array
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row); // Extract row values to variables
            $travelItem = array(
                "id" => $id,
                "name" => $name,
                "seats_available" => $seats_available
            );
            $travelsArray[] = $travelItem;
        }

        // Set the HTTP response code to 200 (OK)
        http_response_code(200);

        // Return the array of travel data as JSON
        echo json_encode($travelsArray);
    } else {
        // Set the HTTP response code to 404 (Not Found) if no records found
        http_response_code(404);

        // Return an error message
        echo json_encode(array("message" => "No travels found with seats_available = $seatsAvailable."));
    }
} else {
    // Return a validation error response if 'seats_available' parameter is missing in the GET request
    http_response_code(400);
    echo json_encode(array("message" => "Invalid or missing 'seats_available' parameter in the GET request."));
}
?>
