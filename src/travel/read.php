<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// includiamo database.php e libro.php per poterli usare
include_once '../config/database.php';
include_once '../models/travel.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto Libro
$travel = new Travel($db);
// query products
$stmt = $travel->read();
$num = $stmt->rowCount();
// se vengono trovati libri nel database

if($num>0){
    // array di libri
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