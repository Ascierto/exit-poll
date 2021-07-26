<?php

function connect(){

    $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "exit_poll");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }

    return $mysqli;
}

?>