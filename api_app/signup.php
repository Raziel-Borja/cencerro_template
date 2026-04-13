<?php 

    include '../db/connection.php';

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $perfil = $_POST['perfil'];
    $password = md5($_POST['password']);

	$info = [];
    $data = [];

    $queryInsert = sprintf("SELECT * FROM users_tb WHERE user_email = '%s'", $email);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert>0) {

        $error = true;
        $msg_error = 'Lo sentimos, ya existe un usuario registrado con ese correo.';

    //Si no lo buscamos como agente
    } else {


        $queryRegister = sprintf("INSERT INTO users_tb (user_name, user_lastname, user_email, user_password, user_privileges, user_phone, user_disabled) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", $name, $lastname, $email, $password, $perfil, $phone, 1);
		$rsRegister = mysqli_query($conn,$queryRegister);

        if ($rsRegister) {
            $error = false;
            $msg_error = 'Registro completado con éxito, espera la confirmación por correo para activar tu cuenta.';
        } else {
            $error = true;
            $msg_error = 'Lo sentimos, ocurrió un error, por favor inténtalo de nuevo.';
        } 
        
        
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