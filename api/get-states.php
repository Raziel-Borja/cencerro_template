<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];

    $queryList = "SELECT * FROM estados";
    $rsList = mysqli_query($conn,$queryList);
    $rowsList = mysqli_fetch_assoc($rsList);
    $totalRowsList = mysqli_num_rows($rsList);

    if ($totalRowsList>0) {

        do {
            array_push($data, array(

                'id' => $rowsList['id'], 
                'name' => $rowsList['estado'],
    
            ));
        } while ($rowsList = mysqli_fetch_assoc($rsList));

        $error = false;
        $msg_error = 'Lista obtenida con éxito';
    } else {
        $error = false;
        $msg_error = 'Lo sentimos, no hay estados dados de alta.';
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