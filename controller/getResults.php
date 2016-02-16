<?php
include_once '../model/Results.php';
// parse the get parameter
$query = "";
$error = 0;
// if there is a query parameter then assign it to the right variable 
if (isset ( $_GET ['query'] )) {
	$query = $_GET ['query'];
} else {
	$error ++;
}
$best = false;
if(isset($_GET["best"]))
	$best=true;
// if thereis no error return the results 
if ($error == 0) {
	$result = new Results();
    $end = 10;
    if($best)
        $end = 2;

    $resultResponse = $result->getResultsLike( $query, 1, $end );
    if(count($resultResponse[0]) <= 1) {
        $resultResponse = $result->getResults( $query, 1, $end );
        try{
            if(count($resultResponse[0]) <= 1) {
                include_once 'Translate.php';
                $trans = new Translate();
                $query = $trans->toEnglish($query);
                $resultResponse = $result->getResults( $query, 1, $end );
            }
        }catch(Exception $e){
            //A translation error occured
        }
    }

    if(count($resultResponse[0]) > 1) {
        if($best) {
            $jsonBestResult = $resultResponse[0][0];
            echo $jsonBestResult["name"] . ", " . $jsonBestResult["address"] . ": " . $jsonBestResult["telephone"];
        }
        else
            echo json_encode($resultResponse);
    }
    else {
        //TODO, no matches found
        echo json_encode(array());
    }

}
else {
	// if there is no parameter return an empty array 
	echo json_encode(array());
}
?>
