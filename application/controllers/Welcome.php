<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct()
    {   
        parent::__construct();
 		$this->load->model("user/adminUser", "adminUser");
    }


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add() {//pasar a función agregar

        $response = $this->adminUser->addUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;                             
		return;

	}

	public function delete() {//pasar a función eliminar

        $response = $this->adminUser->deleteUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
        echo $jsonstring;
        return;
	}

	public function modifyId() {//pasar a función buscador e implementador Id modificar

        $response = $this->adminUser->modifyIdUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;                             

	}

	public function modify() {//pasar a función modificar

        $response = $this->adminUser->modifyUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
        echo $jsonstring;
        return;                       

	}
		
	public function searsh(){//pasar a función listar 
			
		$response = $this->adminUser->searshUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;

	}

	public function list(){//pasar a función listar 
		
		$response = $this->adminUser->listUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;

	}
}
