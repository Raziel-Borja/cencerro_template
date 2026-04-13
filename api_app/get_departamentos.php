<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];

    $queryInsert = "SELECT * FROM departamentos_tb WHERE disabled = '0'";
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert>0) {

        do {
            array_push($data, array(
                'id' => $rowsInsert['id'], 
                'name' => $rowsInsert['name'],
                'image' => $rowsInsert['image'],
                'ruta' => '/uploads/departamentos/'.$rowsInsert['id'].'/'.$rowsInsert['image'].''
                )
            );
        } while ($rowsInsert = mysqli_fetch_assoc($rsInsert));

        $error = false;
        $msg_error = 'Info obtenida con éxito';

    }else{
        $error = true;
        $msg_error = 'Lo sentimos, intenta por favor de nuevo.';
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