<?php

    include('database.php');

    if(isset($_POST['id'])){

    $id = $_POST['id'];
    $query ="delete from task where id = $id";
    $result = mysqli_query($connection, $query);
    
    if(!$result){
        die/('failed eliminación');
    }
    echo 'eliminación correctamente';

    }

?>