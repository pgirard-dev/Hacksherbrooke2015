
function getResults(query) {

    if(query.length == 0 || query.match('/^(\s)*$/')){
        console.log("null");
    	return;
    }
    
    for(var i = results.length - 1; i >= 0; i--) {
        results[i].remove(); //remove the DOM element associated to all the results
    }
    results.length = 0;

    
    var userLat;
    var userLng;
    
    // get position
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
        }
    }
    function showPosition(position) {
        userLat = position.coords.latitude;
        userLng = position.coords.longitude; 
    }
    function toRad(deg) {
    	return deg / (2 * Math.PI);
    }
    function calculateDist(lat, lng){
    	console.log(lat + " " + lng);
    	console.log(userLat + " " + userLng);
    	if(userLat == null || userLng == null){
    		userLat = 45.365164199999995;
    		userLng = -71.8464674;
    	}
    	var R = 6371000; // metres
    	var φ1 = toRad(userLat);
    	var φ2 = toRad(lat);
    	var Δφ = toRad(lat-userLat);
    	var Δλ = toRad(lng-userLng);

    	var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
    	        Math.cos(φ1) * Math.cos(φ2) *
    	        Math.sin(Δλ/2) * Math.sin(Δλ/2);
    	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

    	var d = R * c;
    	
    	console.log(d/10000);
    	return d/10000;
    }
    
    $.getJSON("controller/getResults.php?query=" + query, function(data) {

        getLocation();
        console.log(userLat + " " + userLng);
     // result is null case 
        if(data.length == 0) {
        	$("#message").text("Il ne semble pas avoir de résultats pour votre recherche. Peut-être vérifier l'orthographe?").css("display", "inline-block");
        	$.getJSON("model/getDefault.php", function(preData) {
        		for(var i = 0; i < preData.length; i++) {
        			var distance = calculateDist(preData[i].latitude, preData[i].longitude);
                    results.push(new Result(preData[i].name, preData[i].address, preData[i].telephone, preData[i].category_id, null, preData[i].website, distance));
                }
        	});
        }
        else {
        	$("#message").text("").css("display", "none");
        	 for(var i = 0; i < data[0].length; i++) {
        		 var distance = calculateDist(data[0][i].latitude, data[0][i].longitude);
                 results.push(new Result(data[0][i].name, data[0][i].address, data[0][i].telephone, data[0][i].category_id, null, data[0][i].website, distance));
             }
        }

       
        
        

    }).fail(function(jqXHR, textStatus, errorThrown) { //if a connection error occurs
		alert("An error occured while trying to load the results: " + textStatus + ", " + errorThrown);
	});
}
