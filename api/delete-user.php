<?php 

    include '../db/connection.php';

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


    print_r(json_encode($info));

?>