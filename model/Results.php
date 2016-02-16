<?php
class Results {
	
	// Initialize medoo
	private $database;
	function __construct() {
	}

    function getResultsLike($text, $index1, $index2) {
        include_once "medoo.min.php";

		// Initialize medoo
		include_once "medooConnection.php";

        //No need to get the categories here

		// select the results from the ids
		$results = array ();
		$results [] = $database->select ( "places", [
				"name",
				"address",
				"telephone",
				"website",
				"image",
				"category_id",
				//ok to ask for those fields too?
				"longitude",
				"latitude"
		], [
				"AND" => [
                    "name[~]" => $text
                ],
				"ORDER" => "description DESC" ,
                "LIMIT" => [$index1, $index2]
		] );

        return $results;
    }

	function getResults($text, $index1, $index2) {
		include_once "medoo.min.php";
		
		// Initialize medoo
		$database = new medoo ( [ 
				'database_type' => 'mysql',
				'database_name' => 'anecdote_gimme',
				'server' => '108.167.140.108',
				'username' => 'anecdote_je',
				'password' => 'hackChamps' 
		] );
		
		// get the categories
		$cats = $database->select ( "words", "category_id", [ 
				"name" => $text 
		] );
		
		// select the results from the ids
		$results = array ();
		$results [] = $database->select ( "places", [ 
				"name",
				"address",
				"telephone",
				"website",
				"image",
				"category_id",
				//ok to ask for those fields too?
				"longitude",
				"latitude" 
		], [
                "AND" => [
                    "category_id" => $cats
                ],
				"ORDER" => "description DESC" ,
                "LIMIT" => [$index1, $index2]
		] );
		/*
		 * echo "<pre>";
		 * print_r($results);
		 * echo "</pre>";
		 */
		
		return $results ;
		/*
		 * $database->select ( "places", [
		 * "words" => ["words.category_id" => "places.category_id"],
		 * "categories" => ["categories.id" => "words.category_id"]
		 * ], [
		 * "places.name",
		 * "places.address",
		 * "places.telephone",
		 * "categories.name"
		 * ], [
		 * "words" => $text
		 * ] );
		 */
		
		/*
		 * include_once 'mySQL_connection.php';
		 *
		 * $req = $bdd->prepare ( "SELECT p.name, p.address, p.telephone, c.name
		 * FROM places p
		 * INNER JOIN words w ON w.category_id = p.category_id
		 * INNER JOIN categories c ON c.id = w.category_id
		 * WHERE w.name = :word" );
		 * $req->execute(array("word" => $text));
		 * $data = $req->fetch();
		 * $req->closeCursor();
		 * return json_encode ( $data );
		 */
	}
}

?>
