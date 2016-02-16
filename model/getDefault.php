<?php 
include_once "medoo.min.php";

// Initialize medoo
include "medooConnection.php";

$results = $database->select("places", ["name",
				"address",
				"telephone",
				"website",
				"image",
				"category_id",
				"longitude",
				"latitude" ], ["id" => [5487, 5488,5489,5490,5491,67,155,5563,5564,5565]]);

echo json_encode($results);
?>