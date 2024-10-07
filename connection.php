<?php

    $database= new mysqli("localhost","root","","archi");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>