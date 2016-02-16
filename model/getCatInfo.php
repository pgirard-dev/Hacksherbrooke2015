<?php
    include_once("mySQL_connection.php");

    $req = $bdd->prepare ("SELECT name, image
                        FROM categories
                        WHERE id = :id");
    $req->execute(array("id" => $_GET['id']));
    $data = $req->fetch();
    $req->closeCursor();

    echo json_encode ( $data );
