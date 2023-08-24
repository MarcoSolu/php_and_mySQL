<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/country.php';

$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

$stmt = $country->read();
$num = $stmt->rowCount();

if($num>0){
    
    $country_arr = array();
    $country_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $country_item = array(
            "id" => $id,
            "name" => $name,
            "travel_name" => $travel_name
        );
        array_push($country_arr["records"], $country_item);
    }
    echo json_encode($country_arr);
}else{
    echo json_encode(
        array("message" => "No country found")
    );
}
?>