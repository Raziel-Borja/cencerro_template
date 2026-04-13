<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];

    $queryList = sprintf("SELECT * FROM privileges_tb WHERE privilege_disabled = '%s'", 0);
	$rsList = mysqli_query($conn,$queryList);
	$rowsList = mysqli_fetch_assoc($rsList);
	$totalRowsList = mysqli_num_rows($rsList);

    if ($totalRowsList>0) {
        do {

			array_push($data, array(

				'id' => $rowsList['privilege_id'], 
				'name' => $rowsList['privilege_name']

			));

		} while ($rowsList = mysqli_fetch_assoc($rsList));


        $error = false;
        $msg_error = 'Lista obtenida con exito';
    } else {
        $error = false;
        $msg_error = 'Lo sentimos, no hay privilegios dados de alta.';
    }
    

    $info = [
        "data" => 
            $data,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    echo json_encode($info);

?>