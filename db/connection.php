<?php

$dbhost = getenv('DB_HOST') ?: "localhost:8889";
$dbuser = getenv('DB_USER') ?: "root";
$dbpass = getenv('DB_PASS') ?: "root";
$db = getenv('DB_NAME') ?: "plataforma_base";

// Suprimir warnings de PHP y manejar el error como JSON
@$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

if ($conn->connect_errno) {
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => 'Error de conexión a la base de datos.',
        'data' => []
    ]);
    exit;
}

?>