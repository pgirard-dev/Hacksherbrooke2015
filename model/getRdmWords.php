<?php
    include_once("mySQL_connection.php");

    function getRdmWords() {
        global $bdd;
        $req = $bdd->prepare ("SELECT name
                            FROM words
                            ORDER BY RAND()
                            LIMIT 15");
        $req->execute();
        $data = $req->fetchAll();
        $req->closeCursor();

        $return = array();

        for($i = 0; $i < count($data); $i++) {
            if(ctype_alnum($data[$i]['name'])){
                $return[$i] = $data[$i]['name']; //Removes the annoying text index
            }
            else {
                $return[$i] = "wifi";
            }
        }

        return json_encode ( $return );
    }
