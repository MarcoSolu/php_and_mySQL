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


if (isset($_GET['travel_name'])) {
    
    $travelNAME = $_GET['travel_name'];

    
    $result = $country->filterByCountry($travelNAME);

    if ($result) {
        
        $countryArray = array();

        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row); 
            $countryItem = array(
                "id" => $id,
                "name" => $name,
                "travel_name" => $travel_name
            );
            $countryArray[] = $countryItem;
        }

        
        http_response_code(200);

        
        echo json_encode($countryArray);
    } else {
        
        http_response_code(404);

        
        echo json_encode(array("message" => "No travels found with travel_id = $travelID."));
    }
} else {
    
    http_response_code(400);
    echo json_encode(array("message" => "Invalid or missing 'travel_id' parameter in the GET request."));
}
?>