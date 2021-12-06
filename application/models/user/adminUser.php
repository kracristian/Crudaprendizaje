<?php

class adminUser extends CI_Model {

//-------------->Listar tabla<-----------------------------------------------------------------------------------------------------

    public function listUseLog(){

	//$sql1 = $this->db->query("SELECT * from task");
    $sql1 = $this->db
            ->select("*")
            ->get("task");
	$result = $sql1->result_array();

	if(!$result) {
        die('query is failed');
    }

    $json = [];
    foreach ($result as $row)  {

        $json[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description']
        );
    }

    return $json;
    }

//-------------->Agregar<-----------------------------------------------------------------------------------------------------
 
    public function addUseLog(){

        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        if(!$name) { return [ 'status' => 400, 'message' => 'Nombre invalido' ]; }
        if(!$description) { return [ 'status' => 400, 'message' => 'Descripcion invalido' ]; }
        if(strlen($name) < 3 || strlen($name) > 50) { return [ 'status' => 400, 'message' => 'el nombre debe de tener más de 3 letras o menos de 50'];}
        if(strlen($description) < 1 || strlen($description) > 500) { return [ 'status' => 400, 'message' => 'el nombre debe de tener más de 3 letras o menos de 50'];}

        // $query = $this->db->get("select * from task where name = '$name' and id != '$id'");
        $agregarQuery = $this->db
                ->select("*")
                ->where('name', $name)
                ->get('task');

        $name_val = $agregarQuery->result_array(); 
        $name_con = count($name_val);  
        
        if($name_con > 0){return [ 'status' => 400, 'message' => 'campo repetido' ];}


        $data = array(
            'name' => $name,
            'description' => $description
        );

        $query = $this->db->insert('task', $data);    
                    
        return [ 'status' => 200, 'message' => 'Tarea creada','refresh' => '0' ];
        
    }

//-------------->Eliminar<-----------------------------------------------------------------------------------------------------
   
    public function deleteUseLog(){

        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $this->db->where('id', $id);
        $this->db->delete('task');

        $response = [ 'status' => 200, 'message' => 'Tarea eliminada' ];
        $jsonstring = json_encode($response);
        echo $jsonstring;
        return;

    }

//-------------->search<-----------------------------------------------------------------------------------------------------

   // public function searshUseLog(){

        $search = $_POST['search'];

        if(!empty($search)){
            //$sql1 = $this->db->query("'SELECT * FROM task WHERE name LIKE '%$search%'");
        
        $sql1 = $this->db
            ->select("*")
            ->like('name', $search)
            ->get("task");

	        $result = $sql1->result_array();

            $json = array();
            foreach ($result as $row) {

             $json[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']);
            } 

            return $json;
        }
    }
//-------------->Id modificar<-----------------------------------------------------------------------------------------------------
    public function modifyIdUseLog(){

        $id = isset($_POST['id']) ? $_POST['id'] : '';

         $sql1 = $this->db
            ->select("*")
            ->where('id', $id)
            ->get("task");

            $result = $sql1->row_array(); // desde la misma consulta le dice que solo traiga un registro
            return $result;

    }    

    //-------------->Modificar<-----------------------------------------------------------------------------------------------------

    public function modifyUseLog(){
        // Recibir parámertros.
        $id = isset($_POST['id']) ? $_POST['id'] : '';   
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['descripcion_1']) ? $_POST['descripcion_1'] : '';
       
        //Validaciones de cantidad de caracteres.
        if(strlen($name) < 3 || strlen($name) > 50) { return [ 'status' => 400, 'message' => 'el nombre debe de tener más de 3 letras o menos de 50'];}
        if(strlen($description) < 1 || strlen($description) > 500) { return [ 'status' => 400, 'message' => 'el nombre debe de tener más de 3 letras o menos de 50'];}
        //Validaciones de existencia de parametros.
        if(!$id) { return [ 'status' => 400, 'message' => 'No se encuentra Id' ]; }
        if(!$name) { return [ 'status' => 400, 'message' => 'No se encuentra nombre' ]; }
        if(!$description) { return [ 'status' => 400, 'message' => 'No se encuentra descripción' ]; }

        // $query = $this->db->get("select * from task where name = '$name' and id != '$id'");
        $query = $this->db
                ->select("*")
                ->where('name', $name)
                ->where('id !=', $id)
                ->get('task');

        $name_val = $query->result_array(); 
        $name_con = count($name_val);  
        
        if($name_con > 0){return [ 'status' => 400, 'message' => 'campo repetido' ];}
           
        //Ingreso de variables a una array.
        $data = array(
            'id' => $id,
            'name' => $name,
            'description'  => $description
        );

        //consulta update y mensaje de confirmación.
        $this->db->replace('task', $data); 
        return [ 'status' => 200, 'message' => 'Modificacion hecha' ];

    }
}
?>