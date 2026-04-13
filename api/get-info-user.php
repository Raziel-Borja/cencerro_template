<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];
    $data2 = [];
    $data3 = [];

    $id = $_POST['id'];

    $queryList = sprintf("SELECT * FROM users_tb WHERE user_id = '%s'", $id);
    $rsList = mysqli_query($conn,$queryList);
    $rowsList = mysqli_fetch_assoc($rsList);
    $totalRowsList = mysqli_num_rows($rsList);

    $queryList2 = sprintf("SELECT * FROM privileges_tb WHERE privilege_disabled = '%s'", 0);
    $rsList2 = mysqli_query($conn,$queryList2);
    $rowsList2 = mysqli_fetch_assoc($rsList2);
    $totalRowsList2 = mysqli_num_rows($rsList2);

    if ($totalRowsList>0) {
        do {

            array_push($data, array(

                'id' => $rowsList['user_id'], 
                'name' => $rowsList['user_name'],
                'lastname' => $rowsList['user_lastname'],
                'email' => $rowsList['user_email'],
                'privileges' => $rowsList['user_privileges'],
                'status' => $rowsList['user_disabled'],
                'type' => '0'

            ));

        } while ($rowsList = mysqli_fetch_assoc($rsList));


        do {

            array_push($data2, array(

                'id' => $rowsList2['privilege_id'], 
                'name' => $rowsList2['privilege_name']

            ));

        } while ($rowsList2 = mysqli_fetch_assoc($rsList2));


        $error = false;
        $msg_error = 'Lista obtenida con exito';
    } else {
        $error = false;
        $msg_error = 'Lo sentimos, no hay usuarios dados de alta.';
    }


    

    $info = [
        "data" => 
            $data,
        "privileges" => 
            $data2,
        "files" => 
            $data3,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    echo json_encode($info);

?>