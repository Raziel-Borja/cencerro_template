<?php 

    include '../db/connection.php';

    $email = $_POST['email'];
    $password = md5($_POST['password']);

	$info = [];
    $data = [];

    $queryInsert = sprintf("SELECT u.*, p.privilege_name FROM users_tb as u
    LEFT JOIN privileges_tb as p ON p.privilege_id = u.user_privileges
    WHERE u.user_email = '%s' AND u.user_password = '%s' AND u.user_disabled = '%s'", $email, $password, 0);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert>0) {

        array_push($data, array(
            'id' => $rowsInsert['user_id'], 
            'name' => $rowsInsert['user_name'].' '.$rowsInsert['user_lastname'],
            'email' => $rowsInsert['user_email'],
            'image' => $rowsInsert['user_image'],
            'privilege_name' => $rowsInsert['privilege_name'],
            'privileges' => $rowsInsert['user_privileges'])
        );

        $error = false;
        $msg_error = 'Logueado con exito';

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