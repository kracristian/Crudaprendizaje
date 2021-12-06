<?php

    include('database.php');

    $id = $_POST['id'];
    $query = "SELECT * FROM task WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query failed');
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $response = [
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description']
        ];
    }
    
    $jsonstring = json_encode($response);
    echo $jsonstring;
?>