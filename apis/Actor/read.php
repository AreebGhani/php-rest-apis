<?php

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    exit;
}

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../Config/Database.php";
include_once "../../Models/Actor.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Actor Object
$actorObj = new Actor($db);

// Actor Query
$result = $actorObj->read();

// Get number of rows
$num = $result->rowCount();

// Check if any actor
if ($num > 0) {
    // Actors Array
    $actorsArray = array();
    $actorsArray["data"] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $actor = array(
            "actor_id" => $actor_id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "last_update" => $last_update,
        );

        // Push to "data"
        array_push($actorsArray["data"], $actor);
    }

    // Turn to JSON
    echo json_encode($actorsArray);
} else {
    // No Actor
    echo json_encode(array(
        "message" => "No Actor Found"
    ));
}
