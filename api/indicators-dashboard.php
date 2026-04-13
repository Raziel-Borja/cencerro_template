<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];
    $data2 = [];
    $data3 = [];
    $data4 = [];
    $dateNow = date('Y-m-d');


    $queryList = "SELECT o.*, v.anio as year, ma.nombre as marca, mo.nombre as modelo, v.color, v.placa, v.serie, t.name as tName, t.lastname as tLastname, a.nombre as aseguradora FROM ordenes_tb as o
    LEFT JOIN vehiculos_tb as v ON v.id = o.vehiculo_id
    LEFT JOIN marcas_tb as ma ON ma.id = v.marca_id
    LEFT JOIN modelos_tb as mo ON mo.id = v.modelo_id
    LEFT JOIN tecnicos_tb as t ON t.id = o.tecnico_id
    LEFT JOIN aseguradoras_tb as a ON a.id = o.aseguradora_id
    WHERE o.estatus = '0'";
    $rsList = mysqli_query($conn,$queryList);
    $rowsList = mysqli_fetch_assoc($rsList);
    $totalRowsList = mysqli_num_rows($rsList);

    // $queryList3 = "SELECT c.*, cl.name as nameCli, cl.lastname as lastnameCli, v.anio, m.nombre as marca, mo.nombre as modelo FROM citas_tb as c
    // LEFT JOIN clients_tb as cl ON cl.id = c.nombre
    // LEFT JOIN vehiculos_tb as v ON v.id = c.vehiculo
    // LEFT JOIN marcas_tb AS m ON m.id = v.marca_id
    // LEFT JOIN modelos_tb as mo ON mo.id = v.modelo_id 
    // WHERE c.estatus = '0'";
    $queryList3 = "SELECT COUNT(id) as totalCitas, fecha FROM citas_tb WHERE estatus = '0' GROUP BY fecha";
    $rsList3 = mysqli_query($conn,$queryList3);
    $rowsList3 = mysqli_fetch_assoc($rsList3);
    $totalRowsList3 = mysqli_num_rows($rsList3);

    $queryList4 = "SELECT * FROM clients_tb WHERE disabled = '0'";
    $rsList4 = mysqli_query($conn,$queryList4);
    $rowsList4 = mysqli_fetch_assoc($rsList4);
    $totalRowsList4 = mysqli_num_rows($rsList4);

    //Obtenemos el listado de ordenes (Fecha promesa entrega)
    $queryList5 = "SELECT COUNT(id) as totalOrdenes, fecha_promesa, id FROM ordenes_tb WHERE fecha_promesa <> '0000-00-00' GROUP BY fecha_promesa";
    $rsList5 = mysqli_query($conn,$queryList5);
    $rowsList5 = mysqli_fetch_assoc($rsList5);
    $totalRowsList5 = mysqli_num_rows($rsList5);

    if ($totalRowsList>0) {

        do {

            $queryList2 = "SELECT i.*, s.nombre as servicio FROM items_ordenes_tb as i
            LEFT JOIN servicios_tb as s ON s.id = i.item_id
            WHERE i.orden_id = '".$rowsList['id']."' AND i.tipo_item = '1' AND i.completado = '0' ORDER BY i.id ASC LIMIT 1";
            $rsList2 = mysqli_query($conn,$queryList2);
            $rowsList2 = mysqli_fetch_assoc($rsList2);
            $totalRowsList2 = mysqli_num_rows($rsList2);

            if ($rowsList['marca'] == NULL) {
                $rowsList['marca'] = '-';
            }

            if ($rowsList['modelo'] == NULL) {
                $rowsList['modelo'] = '-';
            }

            if ($rowsList['year'] == NULL) {
                $rowsList['year'] = '-';
            }

            if ($rowsList['placa'] == NULL) {
                $rowsList['placa'] = '-';
            }

            if ($rowsList['serie'] == NULL) {
                $rowsList['serie'] = '-';
            }

            if ($rowsList2['servicio'] == NULL) {
                $rowsList2['servicio'] = '-';
            }

            array_push($data, array(

                'id' => $rowsList['id'],
                'fecha_ingreso' => $rowsList['fecha_ingreso'],
                'fecha_promesa' => $rowsList['fecha_promesa'],
                'marca' => $rowsList['marca'],
                'modelo' => $rowsList['modelo'],
                'anio' => $rowsList['year'],
                'color' => $rowsList['color'],
                'placa' => $rowsList['placa'],
                'serie' => $rowsList['serie'],
                'servicio' => $rowsList2['servicio'],
                'aseguradora' => $rowsList['aseguradora'],
                'asesor' => $rowsList['tName'].' '.$rowsList['tLastname'],
                'tecnico_id' => $rowsList2['tecnico']

    
            ));
        } while ($rowsList = mysqli_fetch_assoc($rsList));

        if ($totalRowsList3>0) {
            do {
                array_push($data2, array(

                    'id' => '',
                    'title' => 'Citas ('.$rowsList3['totalCitas'].')',
                    'start' => $rowsList3['fecha'],
                    'end' => $rowsList3['fecha'],
                    'color' => '#3788d8',
                    'classNames' => 'cita'
        
                ));
            } while ($rowsList3 = mysqli_fetch_assoc($rsList3));
        }

        if ($totalRowsList4>0) {
            do {
                array_push($data3, array(

                    'id' => $rowsList4['id'],
                    'name' => $rowsList4['name'].' '.$rowsList4['lastname']
        
                ));
            } while ($rowsList4 = mysqli_fetch_assoc($rsList4));
        }

        if ($totalRowsList5>0) {
            do {
                array_push($data2, array(

                    'id' => $rowsList5['id'],
                    'title' => 'Promesa ('.$rowsList5['totalOrdenes'].')',
                    'start' => $rowsList5['fecha_promesa'],
                    'end' => $rowsList5['fecha_promesa'],
                    'color' => '#ffb910',
                    'classNames' => 'orden'
        
                ));
            } while ($rowsList5 = mysqli_fetch_assoc($rsList5));
        }

        $error = false;
        $msg_error = 'Lista obtenida con éxito';

    }else{

        $error = true;
        $msg_error = 'Lo sentimos, ha ocurrido un error, por favor inténtalo de nuevo.';

    }
    
    

    $info = [
        "ordenes" => 
            $data,
        "citas" => 
            $data2,
        "clients" => 
            $data3,
        // "fecha_promesa" => 
        //     $data4,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    echo json_encode($info);

?>