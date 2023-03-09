<?php
$host = 'localhost';
$username = 'philipp'; 
$password = 'password'; 
$database = '151_5_benutzer';


// mit der Datenbank verbinden
$mysqli = new mysqli($host, $username, $password, $database);


// Fehlermeldung, falls Verbindung fehl schlägt.
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

?>