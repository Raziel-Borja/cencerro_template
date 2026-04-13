<?php

$dbhost = "localhost:8889";
$dbuser = "root";
$dbpass = 'root';
$db = "plataforma_base";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);


?>