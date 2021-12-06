<?php

header('Content-Type: application/json; charset=utf-8');

    include('database.php');

    // Recibir parámertros
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['descripcion_1']) ? $_POST['descripcion_1'] : '';

    
    // Validar parámetros
    //if(!$id) { $response = 'Id invalido'; }
    if(!$id) { 
        $response = [ 'status' => 400, 'message' => 'ID invalido', 'data' => 'no llegaron datos del ID' ]; 
        $jsonstring = json_encode($response);
        echo $jsonstring;
        return;
    }
    if(!$name) { 
        $response = [ 'status' => 400, 'message' => 'name invalido', 'data' => 'no llegaron datos del Nombre' ]; 
        $jsonstring = json_encode($response);
        echo $jsonstring;
        return;
    }
    
 if(!$description) { 
        $response = [ 'status' => 400, 'message' => 'name invalido', 'data' => 'no llegaron datos de la Descripción' ]; 
        $jsonstring = json_encode($response);
        echo $jsonstring;
        return;
    }

    // Validar nórmas
    if(strlen($name) < 3 || strlen($name) > 50) {
        $response = [ 'status' => 400, 'message' => 'name invalido (minimo 3 caracteres | max 50)' ]; 
        $jsonstring = json_encode($response);
        echo $jsonstring;
        return;
     }
     

            $sql1 ="select * from task where name = '$name' and id != '$id'";
            $sql1resultado = mysqli_query($connection, $sql1);
            $fila = mysqli_num_rows($sql1resultado);
            if($fila == 1) {$response = [ 'status' => 400, 'message' => 'Tarea repetida' ];
                $jsonstring = json_encode($response);
                echo $jsonstring;
                return;
             }

            $sql1d ="select * from task where description = '$description' and id != '$id'";
            $sql1resultadod = mysqli_query($connection, $sql1d);
            $filad = mysqli_num_rows($sql1resultadod);
            if($filad) {$response = [ 'status' => 400, 'message' => 'Descripción repetida'];
                $jsonstring = json_encode($response);
                echo $jsonstring;
                return;
             }
              
            if($fila == 0 && $filad == 0){
                $query = "UPDATE task SET name = '$name', description = '$description' where id = '$id'";    
                $result = mysqli_query($connection, $query);

                $response = [ 'status' => 200, 'message' => 'Tarea exitosa' ];
                $jsonstring = json_encode($response);
                echo $jsonstring;
                return;
            } 
     
            
?>