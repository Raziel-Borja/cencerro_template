<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];

    $id = $_POST['idState'];

    $queryList = sprintf("SELECT em.*, m.municipio, m.id as munid FROM estados_municipios as em
    LEFT JOIN municipios as m ON m.id = em.municipios_id
    WHERE em.estados_id = '%s'", $id);
    $rsList = mysqli_query($conn,$queryList);
    $rowsList = mysqli_fetch_assoc($rsList);
    $totalRowsList = mysqli_num_rows($rsList);

    if ($totalRowsList>0) {

        do {
            array_push($data, array(

                'id' => $rowsList['munid'], 
                'name' => $rowsList['municipio'],
    
            ));
        } while ($rowsList = mysqli_fetch_assoc($rsList));

        $error = false;
        $msg_error = 'Lista obtenida con éxito';
    } else {
        $error = false;
        $msg_error = 'Lo sentimos, no hay municipios dados de alta.';
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