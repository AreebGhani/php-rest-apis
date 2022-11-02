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

// Get ID
$actorObj->actor_id = isset($_GET['id']) ? $_GET["id"] : die();

// Get Actor
$actorObj->find();

// Create Array
$actorArray = array(
    "actor_id" => $actorObj->actor_id,
    "first_name" => $actorObj->first_name,
    "last_name" => $actorObj->last_name,
    "last_update" => $actorObj->last_update,
);

// Turn to JSON
if ($actorObj->first_name !== null && $actorObj->last_name !== null && $actorObj->last_update !== null) {
    print_r(json_encode($actorArray));
} else {
    // No Actor
    echo json_encode(array(
        "id" => $actorObj->actor_id,
        "message" => "No Actor Found",
    ));
}
