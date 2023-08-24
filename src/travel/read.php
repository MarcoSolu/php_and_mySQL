<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/travel.php';

$database = new Database();
$db = $database->getConnection();

$travel = new Travel($db);

$stmt = $travel->read();
$num = $stmt->rowCount();


if($num>0){
    
    $travel_arr = array();
    $travel_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $travel_item = array(
            "id" => $id,
            "name" => $name,
            "seats_available" => $seats_available
        );
        array_push($travel_arr["records"], $travel_item);
    }
    echo json_encode($travel_arr);
}else{
    echo json_encode(
        array("message" => "No travel found")
    );
}
?>