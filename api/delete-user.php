<?php 
    header('Content-Type: application/json');
    ini_set('display_errors', 0);
    error_reporting(E_ALL);

    include dirname(__DIR__) . '/db/connection.php';

    $id = $_POST['id'];

	$info = [];

    $queryDelete = sprintf("DELETE FROM users_tb WHERE user_id = '%s'", $id);
	$rsDelete = mysqli_query($conn,$queryDelete);

    if ($rsDelete) {

        $error = false;
        $msg_error = 'Eliminado con exito';
    } else {
        $error = true;
        $msg_error = 'Lo sentimos, ha ocurrido un error.';
    }
    

    $info = [
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    echo json_encode($info);

?>