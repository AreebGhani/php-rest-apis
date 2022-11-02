<?php

if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
    exit;
}

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers");

include_once "../../Config/Database.php";
include_once "../../Models/Actor.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Actor Object
$actorObj = new Actor($db);

// Get Raw Posted Data
$data = json_decode(file_get_contents("php://input"));

// If Data Found
if ($data) {

    $actorObj->actor_id = $data->actor_id;
    $actorObj->first_name = $data->first_name;
    $actorObj->last_name = $data->last_name;

    // Update Actor
    if ($actorObj->update()) {
        echo json_encode(array(
            "message" => "Actor Updated",
        ));
    } else {
        echo json_encode(array(
            "message" => "Actor Not Updated",
        ));
    }
}
