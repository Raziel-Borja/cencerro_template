<?php 

    include '../db/connection.php';

    $id = $_POST['id'];

	$info = [];
    $data = [];
    $data2 = [];

    $queryInsert = "SELECT * FROM users_tb WHERE user_privileges = '6'";
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert>0) {

        do {
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
        } while ($rowsInsert = mysqli_fetch_assoc($rsInsert));

        
        $error = false;
        $msg_error = 'Info obtenida con éxito';
    }


    $queryInsert2 = "SELECT * FROM users_tb WHERE user_privileges = '5'";
	$rsInsert2 = mysqli_query($conn,$queryInsert2);
	$rowsInsert2 = mysqli_fetch_assoc($rsInsert2);
	$totalRowsInsert2 = mysqli_num_rows($rsInsert2);

    if ($totalRowsInsert2>0) {

        do {
            array_push($data2, array(
                'id' => $rowsInsert2['user_id'], 
                'name' => $rowsInsert2['user_name'],
                'lastname' => $rowsInsert2['user_lastname'],
                'email' => $rowsInsert2['user_email'],
                'phone' => $rowsInsert2['user_phone'],
                'image' => $rowsInsert2['user_image'],
                'privilege_name' => $rowsInsert2['privilege_name'],
                'privileges' => $rowsInsert2['user_privileges'])
            );
        } while ($rowsInsert2 = mysqli_fetch_assoc($rsInsert2));
        
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