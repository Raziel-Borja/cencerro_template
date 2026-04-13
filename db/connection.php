<?php

$dbhost = getenv('DB_HOST') ?: "localhost:8889";
$dbuser = getenv('DB_USER') ?: "root";
$dbpass = getenv('DB_PASS') ?: "root";
$db = getenv('DB_NAME') ?: "plataforma_base";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn->error);


?>