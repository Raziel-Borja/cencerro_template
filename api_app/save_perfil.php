<?php 

    include '../db/connection.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

// error_reporting(E_ALL);

	$info = [];
    $data = [];

    //Variables para validar si hay imagen o no
    $queryAdd1 = '';
    $queryAdd2 = '';


    if ($_POST['password'] !== '') {
        $pass = md5($_POST['password']);
        $queryAdd2 .= ", user_password = '".$pass."'";
    }

    $queryUpdate = "UPDATE users_tb SET user_name = '".$name."', user_lastname = '".$lastname."', user_email = '".$email."', user_phone = '".$phone."'".$queryAdd2." WHERE user_id = '".$id."'";
	$rsUpdate = mysqli_query($conn,$queryUpdate);


    if ($rsUpdate) {

        $error = false;
        $msg_error = 'Usuario actualizado con éxito';
    } else {
        $error = true;
        $msg_error = 'Lo sentimos, algo salio mal, intenta de nuevo.';
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