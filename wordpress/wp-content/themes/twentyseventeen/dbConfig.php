<?php

// Create connection
$conn = new mysqli('localhost', 'root', '', 'cms');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getConnecion(){
    $conn = new mysqli('localhost', 'root', '', 'cms');
    return $conn;
}
?>