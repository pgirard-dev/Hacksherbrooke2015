<?php
include_once "medoo.min.php";

// Initialize medoo
include_once "medooConnection";

$res = $database->select ( "places", [ 
		"id",
		"address",
		"latitude",
		"longitude" 
], [ 
		"AND" => [ 
				"OR" => [ 
						"latitude" => NULL,
						"longitude" => NULL 
				],
				"address[!]" => "null null" 
		] 
] );

echo "<pre>";
print_r ( $res );
echo "</pre>";

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style type="text/css">
</style>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
	<div id="map"></div>
	<p id="data">data</p>
	<script>
	
      function initialize() {
        var map = document.getElementById("map");
        var data = document.getElementById("data");
        var service = new google.maps.places.PlacesService(map);
        // loop here 
        var json = <?php echo json_encode($res)?>;
        console.log(json);

        	var obj = json[0];
            var address = obj.address + ", Sherbrooke";
            service.textSearch({query: address}, function(res) {
              console.log(address, res);
              var lat = res[0].geometry.location.lat();
              var lng = res[0].geometry.location.lng();
              
              console.log("lat: " + lat +  " lng: " + lng);

              // ajax to upload
                  $.ajax({
                    type: 'GET',
                    url: 'ajaxUpdate.php',
                    data: 'id=' + obj.id + "&lat=" + lat + "&lng=" + lng,
                    timeout: 3000,
                    success: function(data) {
                   //   alert(data);
                       },
                    error: function() {
                      alert('La requête n\'a pas abouti'); }
                  });    
            });
            location.reload();
         // loop here
      }
      initialize();
      
    </script>
	<script type="text/javascript">
    
    </script>
</body>
</html>
