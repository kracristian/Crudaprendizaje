<?php
    
    header('Content-Type: application/json; charset=utf-8');
    include('database.php');

    // Recibir parámertros
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // Validar parámetros
    if(!$name) { 
        $response = [ 'status' => 400, 'message' => 'name invalido', 'data' => 'no llegaron datos del Nombre','refresh' => 'no' ]; 
        $jsonstring = json_encode($response);
        echo $jsonstring;
        return;
    }
    if(!$description) { 
        $response = [ 'status' => 400, 'message' => 'name invalido', 'data' => 'no llegaron datos de la Descripción','refresh' => 'no' ]; 
        $jsonstring = json_encode($response);
        echo $jsonstring;
        return;
    }

// Validar nórmas
        if(strlen($name) < 3 || strlen($name) > 50) {
                $response = [ 'status' => 400, 'message' => 'name invalido (minimo 3 caracteres | max 50)','refresh' => 'no' ]; 
                $jsonstring = json_encode($response);
                echo $jsonstring;
                return;
            }
            
            $sql1 ="select * from task where name = '$name'";
            $sql1resultado = mysqli_query($connection, $sql1);
            $fila = mysqli_num_rows($sql1resultado);

        if($fila == 1) {$response = [ 'status' => 400, 'message' => 'Tarea repetida','refresh' => 'no' ];
                $jsonstring = json_encode($response);
                echo $jsonstring;
                return;
             }

            $sql1d ="select * from task where description = '$description'";
            $sql1resultadod = mysqli_query($connection, $sql1d);
            $filad = mysqli_num_rows($sql1resultadod);

        if($filad) {$response = [ 'status' => 400, 'message' => 'Descripción repetida','refresh' => 'no'];
            $jsonstring = json_encode($response);
            echo $jsonstring;
                return;
             }

        if($fila == 0 && $filad == 0){
            $query = "INSERT INTO task(name, description) VALUES ('$name','$description')";
            $result = mysqli_query($connection, $query);

        }
            $response = [ 'status' => 200, 'message' => 'Tarea creada','refresh' => '0' ];
            $jsonstring = json_encode($response);
            echo $jsonstring;
            return;

 }
       
?>