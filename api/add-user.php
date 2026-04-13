<?php 

    include '../db/connection.php';

    $name = $_POST['name-user'];
    $lastname = $_POST['lastname-user'];
    $email = $_POST['email-user'];
    $password = md5($_POST['pass-user']);
    $perfil = $_POST['perfil'];
    $img = $_FILES['img']['name'][0];

    //Variables para validar si hay imagen o no
    $queryAdd1 = '';
    $queryAdd2 = '';

    //Si existe la imagen, llenamos las variables
    if ($_FILES['img']['name'][0] != '') {
        $queryAdd1 .= ", user_image";
        $queryAdd2 .= ", '%s'";
    }

	$info = [];

    $queryInsert = sprintf("SELECT * FROM users_tb WHERE user_email = '%s'", $email);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert === 0) {

        $queryRegister = sprintf("INSERT INTO users_tb (user_name, user_lastname, user_email, user_password, user_privileges".$queryAdd1.") VALUES ('%s', '%s', '%s', '%s', '%s'".$queryAdd2.")", $name, $lastname, $email, $password, $perfil, $img);
		$rsRegister = mysqli_query($conn,$queryRegister);

        $elid = $conn->insert_id;
        
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["img"]["name"][0]);
        $file_extension = end($temporary);
        $folder = "../uploads/users/image_perfil/".$elid."";
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }
        $sourcePath = $_FILES['img']['tmp_name'][0];
        $targetPath = "".$folder."/".$_FILES['img']['name'][0];
        move_uploaded_file($sourcePath,$targetPath);

        $error = false;
        $msg_error = 'Insertado con exito';
    } else {
        $error = true;
        $msg_error = 'Lo sentimos, Ese correo ya se encuentra registrado.';
    }
    

    $info = [
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>