<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/country.php';

$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

// Check if the 'seats_available' parameter exists in the GET request
if (isset($_GET['travel_name'])) {
    // Get the seats_available value from the GET parameters
    $travelNAME = $_GET['travel_name'];

    // Call the filterBySeats function with the provided value
    $result = $country->filterByCountry($travelNAME);

    if ($result) {
        // Initialize an array to store the rows
        $countryArray = array();

        // Fetch the rows one by one and add them to the array
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row); // Extract row values to variables
            $countryItem = array(
                "id" => $id,
                "name" => $name,
                "travel_name" => $travel_name
            );
            $countryArray[] = $countryItem;
        }

        // Set the HTTP response code to 200 (OK)
        http_response_code(200);

        // Return the array of travel data as JSON
        echo json_encode($countryArray);
    } else {
        // Set the HTTP response code to 404 (Not Found) if no records found
        http_response_code(404);

        // Return an error message
        echo json_encode(array("message" => "No travels found with travel_id = $travelID."));
    }
} else {
    // Return a validation error response if 'seats_available' parameter is missing in the GET request
    http_response_code(400);
    echo json_encode(array("message" => "Invalid or missing 'travel_id' parameter in the GET request."));
}
?>