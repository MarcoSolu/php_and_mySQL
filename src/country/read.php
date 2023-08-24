<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// includiamo database.php e libro.php per poterli usare
include_once '../config/database.php';
include_once '../models/country.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto Libro
$country = new Country($db);
// query products
$stmt = $country->read();
$num = $stmt->rowCount();
// se vengono trovati libri nel database
if($num>0){
    // array di libri
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