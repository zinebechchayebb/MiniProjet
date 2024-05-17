<?php

$mysqli = new mysqli('localhost', 'root', '', 'attsystem');

// Check connection
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>
