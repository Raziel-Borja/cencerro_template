<?php 

    include '../db/connection.php';

    $id = $_POST['id'];

	$info = [];
    $data = [];

    $queryInsert = sprintf("SELECT * FROM users_tb WHERE user_id = '%s'", $id);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert>0) {

        array_push($data, array(
            'id' => $rowsInsert['user_id'], 
            'name' => $rowsInsert['user_name'],
            'lastname' => $rowsInsert['user_lastname'],
            'email' => $rowsInsert['user_email'],
            'phone' => $rowsInsert['user_phone'],
            'image' => $rowsInsert['user_image'],
            'privilege_name' => $rowsInsert['privilege_name'],
            'privileges' => $rowsInsert['user_privileges'])
        );
        
        $error = false;
        $msg_error = 'Info obtenida con éxito';

    //Si no lo buscamos como agente
    } else {


        $error = true;
        $msg_error = 'Lo sentimos, por favor verifica tu correo electrónico y/o contraseña';
        
    }
    

    $info = [
        "data" => 
            $data,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>