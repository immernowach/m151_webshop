<?php
$host = 'localhost';
$username = 'webshop'; 
$password = 'webshop'; 
$database = 'webshop';


// mit der Datenbank verbinden
$mysqli = new mysqli($host, $username, $password, $database);


// Fehlermeldung, falls die Verbindung fehl schlägt.
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

?>