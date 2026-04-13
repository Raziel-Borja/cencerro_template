<?php 

    include '../db/connection.php';

    $idPersonal = $_POST['id_personal'];
    $idDepartamento = $_POST['id_departamento'];

	$info = [];
    $data = [];
    $data2 = [];

    $queryInsert = sprintf("SELECT * FROM users_tb WHERE user_id = '%s'", $idPersonal);
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
            'url' => '/uploads/users/'.$rowsInsert['id'].'/'.$rowsInsert['image'].'', 
            'privilege_name' => $rowsInsert['privilege_name'],
            'privileges' => $rowsInsert['user_privileges'])
        );
        
        $error = false;
        $msg_error = 'Info obtenida con éxito';

    }

    $queryInsert2 = sprintf("SELECT * FROM departamentos_tb WHERE id = '%s'", $idDepartamento);
	$rsInsert2 = mysqli_query($conn,$queryInsert2);
	$rowsInsert2 = mysqli_fetch_assoc($rsInsert2);
	$totalRowsInsert2 = mysqli_num_rows($rsInsert2);

    if ($totalRowsInsert2>0) {

        array_push($data2, array(
            'id' => $rowsInsert2['id'], 
            'name' => $rowsInsert2['name'], 
            'image' => $rowsInsert2['image'],
            'url' => '/uploads/departamentos/'.$rowsInsert2['id'].'/'.$rowsInsert2['image'].'' 
            )
        );
        
        $error = false;
        $msg_error = 'Info obtenida con éxito';
        
    }
    

    $info = [
        "data" => 
            $data,
        "data2" => 
            $data2,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>