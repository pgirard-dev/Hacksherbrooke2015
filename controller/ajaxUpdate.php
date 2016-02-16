<?php
include_once "medoo.min.php";
$id = $_GET ["id"];
$lat = $_GET ["lat"];
$lng = $_GET ["lng"];

// Initialize medoo
include_once "medooConnection";

$database->update("places", ["latitude" => $lat, "longitude" => $lng], ["id" => $id]);

?>